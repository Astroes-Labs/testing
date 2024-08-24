 $(document).ready(function () {
    function isInFolder(folder) {
        // Get the current URL path
        var currentPath = window.location.pathname;

        // Normalize folder to end with a slash for accurate comparison
        if (!folder.endsWith('/')) {
            folder += '/';
        }

        // Check if the path starts with the specified folder
        return currentPath.startsWith('/' + folder);
    }
    function isInFolderBeforeFile(folderToMatch) {
        // Get the current URL path
        var currentPath = window.location.pathname;
    
        // Normalize the path by removing leading and trailing slashes
        currentPath = currentPath.replace(/^\/|\/$/g, '');
    
        // Split the path into segments
        var segments = currentPath.split('/');
    
        // Check if the path has at least 2 segments (folder/file)
        if (segments.length >= 2) {
            // Get the folder immediately before the file
            var folderBeforeFile = segments[segments.length - 2];
    
            // Compare with the supplied folder name
            return folderBeforeFile === folderToMatch;
        }
    
        // Return false if there are not enough segments
        return false;
    }
    function handleRedirect(href, targetUrl, redirectTo, event) {
    if (href === targetUrl) {
        // Prevent the default action (following the link)
        event.preventDefault();

        // Redirect to the specified URL
        window.location.href = redirectTo;
    }
    }

    $("a").on("click", function (event) {
    // Get the href attribute of the clicked link
    var href = $(this).attr("href");
    if (isInFolderBeforeFile('d')) {
        handleRedirect(href, "index.html", "../home.html", event);
    }else{
        handleRedirect(href, "login.html", "d/login.html", event);
        handleRedirect(href, "register.html", "d/register.html", event);
    }
    });


    
    var api = '../api.php';
    $.ajax({
        url: api, // Replace with your server endpoint
        method: 'POST',
        data: {
            isLoggedIn: 'check',
        },
        success: function(response) {
            console.log(response);
            if(response.message === 'Success'){
                if (isInFolderBeforeFile('d')) {
                    window.location.href = 'index.html';
                }else{
                    window.location.href = 'd/index.html';
                }
            }
        },
        error: function(xhr, status, error) {
            // Handle error response
            showToast("danger-lighter", 'An error occurred: ' + error);
        }
    });
});


