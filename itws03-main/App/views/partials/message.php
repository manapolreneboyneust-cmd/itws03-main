<?php
use Framework\Session;
use Framework\Authorization;

$successMessage = Session::getFlashMessage('success_message'); ?>
<?php if($successMessage): ?>
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
        <?= $successMessage ?>
    </div>
<?php endif; ?>

<?php $errorMessage = Session::getFlashMessage('error_message'); ?>
<?php if($errorMessage): ?>
    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
        <?= $errorMessage ?>
    </div>
<?php endif; ?>

