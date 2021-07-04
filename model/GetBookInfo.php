<?php


class GoogleBooksAPIInfo
{
    protected $book_name;
    protected $api_key = 'AIzaSyAUc2AIbUgEn4dzSMVVY6xR2bcRrVnz0Qc';

    public function __construct($book_name){
        $this->book_name = $book_name;
    }

    public function get_book_info()
    {
        $q = urlencode($this->book_name);
        $endpoint = 'https://www.googleapis.com/books/v1/volumes?q=' . $q . '&key=' . $this->api_key;
        $ch = curl_init($endpoint);
        try {
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $response = curl_exec($ch);
            if (curl_errno($ch)) {
                echo curl_error($ch);
                die();
            }
            $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            if ($http_code == intval(200)) {
                echo json_encode($response);
            } else {
                echo "Ressource introuvable : " . $http_code;
            }
        } catch
        (\Throwable $th) {
            throw $th;
        } finally {
            curl_close($ch);
        }
    }
}