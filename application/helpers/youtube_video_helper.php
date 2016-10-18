<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

    // Create youtube video link for representing a video
    function show_youtube($video_link)
    {
        if (!empty($video_link)) {
            return 'http://www.youtube.com/v/' . _get_youtube_id_from_url($video_link);
        }
    }

    // Get youtuve video id from url
    function _get_youtube_id_from_url($url)
    {
        $pattern = 
            '%^# Match any youtube URL
            (?:https?://)?  # Optional scheme. Either http or https
            (?:www\.)?      # Optional www subdomain
            (?:             # Group host alternatives
              youtu\.be/    # Either youtu.be,
            | youtube\.com  # or youtube.com
              (?:           # Group path alternatives
                /embed/     # Either /embed/
              | /v/         # or /v/
              | /watch\?v=  # or /watch\?v=
              )             # End path alternatives.
            )               # End host alternatives.
            ([\w-]{10,12})  # Allow 10-12 for 11 char youtube id.
            $%x'
            ;
        $result = preg_match($pattern, $url, $matches);
        if (false !== $result) {
            return $matches[1];
        }
        return false;
    }

?>