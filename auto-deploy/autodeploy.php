<?php
function file_force_contents($dir, $contents)
{
    $parts = explode('/', $dir);
    $file = array_pop($parts);
    $dir = '';
    foreach ($parts as $part)
        if (!is_dir($dir .= "/$part")) mkdir($dir);
    $contents = "[" . date("h:i A") . "] " . $contents;
    file_put_contents("$dir/$file", $contents, FILE_APPEND );
}
$command = "docker image inspect --format '{{json .RepoDigests}}' luandnh1998/nodejs:lastest";
$docker_url = "https://hub.docker.com/v2/repositories/luandnh1998/nodejs/tags/lastest";
$file = "/var/log/deploy/nodejsautodeploy";
$usename = "luandnh1998";
$password = "jenkins1998";
$result = exec($command, $output, $status);
if ($status == 1) {
    $content = "[ERROR] Fail to get docker information from system!\n";
    file_force_contents($file,$content);
    die();
} else {
    $output_json = json_decode($result);
    $digest_string = $output_json[0];
    $digestArr = explode("sha256:", $digest_string);
    $repoDigest = $digestArr[1];
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $docker_url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $output_api = curl_exec($ch);
    $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
    if ($http_code != 200) {
        $content = "[ERROR] Fail to get docker information from API!\n";
        file_force_contents($file,$content);
        die();
    }
    $output_api = json_decode($output_api);
    $images = $output_api->images;
    $image_digest_string = $images[0]->digest;
    $digestArr = explode("sha256:", $image_digest_string);
    $image_digest = $digestArr[1];
    if ($repoDigest == $image_digest) {
        $content = "[INFO] Same repo and images\n";
        file_force_contents($file,$content);
        die();
    } else {
        $content = "[INFO] Deploy new images\n";
        file_force_contents($file,$content);
        $content = "[INFO] Remove old container\n";
        file_force_contents($file,$content);
        echo shell_exec('sh /root/jenkins-finalproject/auto-deploy/remove_old_container.sh');
        $content = "[INFO] Start Deploy new container\n";
        file_force_contents($file,$content);
        echo shell_exec('sh /root/jenkins-finalproject/auto-deploy/deploy.sh');
        $content = "[INFO] Finish Deploy new container\n";
        file_force_contents($file,$content);
        die();
    }
}
die();
