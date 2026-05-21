<footer class="bg-blue-900 text-white mt-20">
    <div class="container mx-auto px-4 py-6">
        <div class="flex justify-between items-center">
            <div class="flex items-center gap-3">
                <svg width="48" height="48" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M21 21L16.65 16.65M19 11C19 15.4183 15.4183 19 11 19C6.58172 19 3 15.4183 3 11C3 6.58172 6.58172 3 11 3C15.4183 3 19 6.58172 19 11Z" stroke="#CFD8DC" stroke-linecap="round" stroke-linejoin="round" />
                    <g clip-path="url(#clip0_0_1)">
                        <path d="M12.6668 14.75V8.08333C12.6668 7.86232 12.579 7.65036 12.4228 7.49408C12.2665 7.3378 12.0545 7.25 11.8335 7.25H10.1668C9.94582 7.25 9.73385 7.3378 9.57757 7.49408C9.42129 7.65036 9.3335 7.86232 9.3335 8.08333V14.75M7.66683 8.91667H14.3335C14.7937 8.91667 15.1668 9.28976 15.1668 9.75V13.9167C15.1668 14.3769 14.7937 14.75 14.3335 14.75H7.66683C7.20659 14.75 6.8335 14.3769 6.8335 13.9167V9.75C6.8335 9.28976 7.20659 8.91667 7.66683 8.91667Z" stroke="#FFC107" stroke-linecap="round" stroke-linejoin="round" />
                    </g>
                    <defs>
                        <clipPath id="clip0_0_1">
                            <rect width="10" height="10" fill="white" transform="translate(6 6)" />
                        </clipPath>
                    </defs>
                </svg>
                <div>
                    <h3 class="text-xl font-bold">JobSeek</h3>
                    <p class="text-gray-200 text-xs mt-1">Find your dream job today.</p>
                </div>
            </div>
            <div class="space-x-4 text-xs text-gray-200">
                <a href="<?= baseUrl('') ?>" class="hover:underline">Home</a>
                <a href="<?= baseUrl('listings') ?>" class="hover:underline">Jobs</a>
                <a href="<?= baseUrl('listings/create') ?>" class="hover:underline">Post a Job</a>
            </div>
        </div>
    </div>
    <div class="copy-right">
        <hr class="border-blue-800 my-4 w-full">
        <p class="text-xs text-black text-center">
            &copy; <?= date('Y'); ?> Jobseek. All rights reserved.
        </p>
    </div>
</footer>

</body>

</html>
