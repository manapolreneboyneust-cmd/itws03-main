<?php

namespace App\Controllers;

use Framework\Authorization;
use Framework\Database;
use Framework\Session;
use Framework\Validation;

class ListingController
    
{
    protected $db;

    public function __construct()
    {
        
        $config = require basePath('config/db.php');

    $this->db = new Database($config);

    }

    public function index() 
    {


    $listings = $this->db->query('SELECT * FROM listings')->fetchALL();
        loadView('listings/index', 
        [
            'listings' => $listings
            ]);
    }
    public function create() 
    {
        loadView('listings/create');
    }

    public function show($params)
    {
        $id = $params['id'] ?? '';
        $params = [
            'id' => $id
        ];
        $listing = $this->db->query('SELECT * FROM listings WHERE id = :id', $params)->fetch();

        if (!$listing) {
            ErrorController::notFound('Listing not found');
            return;
        }

        loadView('listings/show', [
            'listing' => $listing
        ]);
    }

    public function edit($params)
    {
        $id = $params['id'] ?? '';
        $listing = $this->db->query('SELECT * FROM listings WHERE id = :id', ['id' => $id])->fetch();

        if (!$listing) {
            ErrorController::notFound('Listing not found');
            return;
        }

        if (!Authorization::isOwner($listing->user_id)) {
            redirect('/');
        }

        loadView('listings/edit', [
            'listing' => $listing,
            'errors' => []
        ]);
    }

    public function update($params)
    {
        $id = $params['id'] ?? '';
        $listing = $this->db->query('SELECT * FROM listings WHERE id = :id', ['id' => $id])->fetch();

        if (!$listing) {
            ErrorController::notFound('Listing not found');
            return;
        }

        if (!Authorization::isOwner($listing->user_id)) {
            redirect('/');
        }

        $allowedFields = [
            'title', 'description', 'salary', 'requirements', 'benefits', 'tags', 'company', 'address', 'city', 'state', 'phone', 'email'
        ];

        $updatedData = array_intersect_key($_POST, array_flip($allowedFields));
        $updatedData = array_map('sanitize', $updatedData);
        $updatedData['id'] = $id;

        $requiredFields = ['title', 'description', 'email', 'city', 'state'];
        $errors = [];

        foreach ($requiredFields as $field) {
            if (empty($updatedData[$field]) || !Validation::string($updatedData[$field])) {
                $errors[$field] = ucfirst($field) . ' is required';
            }
        }

        if (!empty($errors)) {
            loadView('listings/edit', [
                'listing' => (object) $updatedData,
                'errors' => $errors
            ]);
            return;
        }

        $this->db->query(
            'UPDATE listings SET title = :title, description = :description, salary = :salary, requirements = :requirements, benefits = :benefits, tags = :tags, company = :company, address = :address, city = :city, state = :state, phone = :phone, email = :email, updated_at = NOW() WHERE id = :id',
            $updatedData
        );

        redirect('/listings/' . $id);
    }

    public function destroy($params)
    {
        $id = $params['id'] ?? '';
        $listing = $this->db->query('SELECT * FROM listings WHERE id = :id', ['id' => $id])->fetch();

        if (!$listing) {
            ErrorController::notFound('Listing not found');
            return;
        }

        if (!Authorization::isOwner($listing->user_id)) {
            redirect('/');
        }

        $this->db->query('DELETE FROM listings WHERE id = :id', ['id' => $id]);
        redirect('/listings');
    }

    public function search()
    {
        $keywords = trim($_GET['keywords'] ?? '');
        $location = trim($_GET['location'] ?? '');

        $conditions = [];
        $params = [];

        if ($keywords !== '') {
            $conditions[] = '(title LIKE :keywords OR description LIKE :keywords OR tags LIKE :keywords OR company LIKE :keywords)';
            $params['keywords'] = "%{$keywords}%";
        }

        if ($location !== '') {
            $conditions[] = '(city LIKE :location OR state LIKE :location OR address LIKE :location)';
            $params['location'] = "%{$location}%";
        }

        $sql = 'SELECT * FROM listings';
        if (!empty($conditions)) {
            $sql .= ' WHERE ' . implode(' AND ', $conditions);
        }
        $sql .= ' ORDER BY created_at DESC';

        $listings = $this->db->query($sql, $params)->fetchAll();

        loadView('listings/index', [
            'listings' => $listings,
            'keywords' => $keywords,
            'location' => $location
        ]);
    }

    public function store()
    {
        $allowedFields = [
            'title', 'description', 'salary', 'requirements', 'benefits', 'tags', 'company', 'address', 'city', 'state', 'phone', 'email'
        ];

        $newListingData = array_intersect_key($_POST, array_flip($allowedFields));
        $newListingData = array_map('sanitize', $newListingData);
        $newListingData['user_id'] = Session::get('user')['id'] ?? null;

        $requiredFields = ['title', 'description', 'email', 'city', 'state'];
        $errors = [];

        foreach ($requiredFields as $field) {
            if (empty($newListingData[$field]) || !Validation::string($newListingData[$field])) {
                $errors[$field] = ucfirst($field) . ' is required';
            }
        }

        if (!empty($errors)) {
            loadView('listings/create', [
                'errors' => $errors,
                'listing' => $newListingData
            ]);
            return;
        }

        $this->db->query(
            'INSERT INTO listings (title, description, salary, requirements, benefits, tags, company, address, city, state, phone, email, user_id) VALUES (:title, :description, :salary, :requirements, :benefits, :tags, :company, :address, :city, :state, :phone, :email, :user_id)',
            $newListingData
        );

        redirect('/listings');
    }
}

