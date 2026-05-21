<?php
use Framework\Session;
?>

<header class="p-4">
    <div class="container mx-auto flex justify-between items-center">
        <h1 class="text-3xl font-semibold">
            <a href="<?= baseUrl('') ?>" class="text-sky-600 hover:underline">JobSeek</a>
        </h1>
        <nav class="flex items-center gap-4">
            <?php if (Session::has('user')): ?>
                <span class="text-sm text-slate-600">Welcome, <?= Session::get('user')['name'] ?? 'Guest'; ?>!</span>
                <form method="POST" action="<?= baseUrl('auth/logout') ?>" class="logout-form m-0">
                    <button type="submit" class="logout-button">Logout</button>
                </form>
                <a href="<?= baseUrl('listings/create') ?>" class="bg-yellow-500 hover:bg-yellow-600 text-black px-4 py-2 rounded hover:shadow-md transition duration-300">
                    <i class="fa fa-edit"></i> Post a Job
                </a>
            <?php else: ?>
                <a href="<?= baseUrl('auth/login') ?>" class="hover:underline">Login</a>
                <a href="<?= baseUrl('auth/register') ?>" class="hover:underline">Register</a>
            <?php endif; ?>
        </nav>
    </div>
</header>


