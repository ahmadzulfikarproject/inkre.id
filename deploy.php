<?php
/**
 * GIT DEPLOYMENT SCRIPT FIKAR WEB DESIGN
 *
 * Used for automatically deploying websites via github or bitbucket, more deets here:
 *
 *		https://gist.github.com/1809044
 */
// The commands
$commands = array(
    'echo $PWD',
    'whoami',
    'git pull',
    'git status',
    'git submodule sync',
    'git submodule update',
    'git submodule status',
    'sh ~/repositories/sewagenset88.com/.git/hooks/post-receive',
);
// Run the commands for output
$output = '';
if ($_SERVER['HTTP_X_GITHUB_EVENT'] == 'push') {
    foreach ($commands as $command) {
        // Run it
        $tmp = shell_exec($command);
        // Output
        $output .= "<span style=\"color: #6BE234;\">\$</span> <span style=\"color: #729FCF;\">{$command}\n</span>";
        $output .= htmlentities(trim($tmp)) . "\n";
    }
}else{
    $base_url = (isset($_SERVER['HTTPS']) ? "https://" : "http://").$_SERVER['HTTP_HOST'].str_replace(basename($_SERVER['SCRIPT_NAME']),"",$_SERVER['SCRIPT_NAME']);
    header("Location: {$base_url}");
    die();
}
// Make it pretty for manual user access (and why not?)
?>
<!DOCTYPE HTML>
<html lang="en-US">

<head>
    <meta charset="UTF-8">
    <title>GIT DEPLOYMENT SCRIPT FIKAR WEB DESIGN</title>
</head>

<body style="background-color: #000000; color: #FFFFFF; font-weight: bold; padding: 0 10px;">
    <pre>
 .  ____  .    ____________________________
 |/      \|   |                            |
[| <span style="color: #FF0000;">&hearts;    &hearts;</span> |]  | Git Deployment Script v0.1 fikar 2021|
 |___==___|  /              &copy; oodavid 2012 |
              |____________________________|

<?php echo $output; ?>
</pre>
</body>

</html>