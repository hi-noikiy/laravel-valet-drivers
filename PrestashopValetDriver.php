<?php

class PrestaShopValetDriver extends ValetDriver
{
    /**
     * Determine if the driver serves the request.
     *
     * @param  string $sitePath
     * @param  string $siteName
     * @param  string $uri
     *
     * @return bool
     */
    public function serves($sitePath, $siteName, $uri)
    {
        return file_exists($sitePath . '/classes/PrestashopAutoload.php');
    }

    /**
     * Determine if the incoming request is for a static file.
     *
     * @param  string $sitePath
     * @param  string $siteName
     * @param  string $uri
     *
     * @return string|false
     */
    public function isStaticFile($sitePath, $siteName, $uri)
    {


  // from http://doc.prestashop.com/display/PS16/System+Administrator+Guide#SystemAdministratorGuide-NginxfriendlyURLs
  // rewrite ^/PRESTASHOP_FOLDER/api/?(.*)$ /PRESTASHOP_FOLDER/webservice/dispatcher.php?url=$1 last;
  // rewrite ^/PRESTASHOP_FOLDER/([0-9])(-[_a-zA-Z0-9-]*)?(-[0-9]+)?/.+\.jpg$ /PRESTASHOP_FOLDER/img/p/$1/$1$2.jpg last;
  // rewrite ^/PRESTASHOP_FOLDER/([0-9])([0-9])(-[_a-zA-Z0-9-]*)?(-[0-9]+)?/.+\.jpg$ /PRESTASHOP_FOLDER/img/p/$1/$2/$1$2$3.jpg last;
  // rewrite ^/PRESTASHOP_FOLDER/([0-9])([0-9])([0-9])(-[_a-zA-Z0-9-]*)?(-[0-9]+)?/.+\.jpg$ /PRESTASHOP_FOLDER/img/p/$1/$2/$3/$1$2$3$4.jpg last;
  // rewrite ^/PRESTASHOP_FOLDER/([0-9])([0-9])([0-9])([0-9])(-[_a-zA-Z0-9-]*)?(-[0-9]+)?/.+\.jpg$ /PRESTASHOP_FOLDER/img/p/$1/$2/$3/$4/$1$2$3$4$5.jpg last;
  // rewrite ^/PRESTASHOP_FOLDER/([0-9])([0-9])([0-9])([0-9])([0-9])(-[_a-zA-Z0-9-]*)?(-[0-9]+)?/.+\.jpg$ /PRESTASHOP_FOLDER/img/p/$1/$2/$3/$4/$5/$1$2$3$4$5$6.jpg last;
  // rewrite ^/PRESTASHOP_FOLDER/([0-9])([0-9])([0-9])([0-9])([0-9])([0-9])(-[_a-zA-Z0-9-]*)?(-[0-9]+)?/.+\.jpg$ /PRESTASHOP_FOLDER/img/p/$1/$2/$3/$4/$5/$6/$1$2$3$4$5$6$7.jpg last;
  // rewrite ^/PRESTASHOP_FOLDER/([0-9])([0-9])([0-9])([0-9])([0-9])([0-9])([0-9])(-[_a-zA-Z0-9-]*)?(-[0-9]+)?/.+\.jpg$ /PRESTASHOP_FOLDER/img/p/$1/$2/$3/$4/$5/$6/$7/$1$2$3$4$5$6$7$8.jpg last;
  // rewrite ^/PRESTASHOP_FOLDER/([0-9])([0-9])([0-9])([0-9])([0-9])([0-9])([0-9])([0-9])(-[_a-zA-Z0-9-]*)?(-[0-9]+)?/.+\.jpg$ /PRESTASHOP_FOLDER/img/p/$1/$2/$3/$4/$5/$6/$7/$8/$1$2$3$4$5$6$7$8$9.jpg last;
  // rewrite ^/PRESTASHOP_FOLDER/c/([0-9]+)(-[_a-zA-Z0-9-]*)(-[0-9]+)?/.+\.jpg$ /PRESTASHOP_FOLDER/img/c/$1$2.jpg last;
  // rewrite ^/PRESTASHOP_FOLDER/([0-9]+)(-[_a-zA-Z0-9-]*)(-[0-9]+)?/.+\.jpg$ /PRESTASHOP_FOLDER/img/c/$1$2.jpg last;


        // Basic static file
        if (is_file($staticFilePath = "{$sitePath}/{$uri}")) {
            return $staticFilePath;
        } 


        // rewrite ^/([0-9])(-[_a-zA-Z0-9-]*)?(-[0-9]+)?/.+\.jpg$ /img/p/$1/$1$2.jpg last;
        if (preg_match('/([0-9])(-[_a-zA-Z0-9-]*)\/(.*)/', $uri, $matches)) {
            $staticFilePath = "{$sitePath}/img/p/{$matches[1]}/{$matches[1]}{$matches[2]}.jpg";
            
            if (is_file($staticFilePath)) {
                return $staticFilePath;
            }
        }


        // rewrite ^/([0-9])([0-9])(-[_a-zA-Z0-9-]*)?(-[0-9]+)?/.+\.jpg$ /img/p/$1/$2/$1$2$3.jpg last;
        if (preg_match('/([0-9])(-[_a-zA-Z0-9-]*)\/(.*)/', $uri, $matches)) {
            $staticFilePath = "{$sitePath}/img/p/{$matches[1]}/{$matches[2]}/{$matches[1]}{$matches[2]}{$matches[3]}.jpg";
            
            if (is_file($staticFilePath)) {
                return $staticFilePath;
            }
        }


        // rewrite ^/([0-9])([0-9])([0-9])(-[_a-zA-Z0-9-]*)?(-[0-9]+)?/.+\.jpg$ /img/p/$1/$2/$3/$1$2$3$4.jpg last;
        if (preg_match('/([0-9])([0-9])([0-9])(-[_a-zA-Z0-9-]*)\/(.*)/', $uri, $matches)) {
            $staticFilePath = "{$sitePath}/img/p/{$matches[1]}/{$matches[2]}/{$matches[3]}/{$matches[1]}{$matches[2]}{$matches[3]}{$matches[4]}.jpg";
            
            if (is_file($staticFilePath)) {
                return $staticFilePath;
            }
        }


        // rewrite ^/([0-9])([0-9])([0-9])([0-9])(-[_a-zA-Z0-9-]*)?(-[0-9]+)?/.+\.jpg$ /img/p/$1/$2/$3/$4/$1$2$3$4$5.jpg last;
        if (preg_match('/([0-9])([0-9])([0-9])(-[_a-zA-Z0-9-]*)\/(.*)/', $uri, $matches)) {
            $staticFilePath = "{$sitePath}/img/p/{$matches[1]}/{$matches[2]}/{$matches[3]}/{$matches[3]}/{$matches[1]}{$matches[2]}{$matches[3]}{$matches[4]}{$matches[5]}.jpg";
            
            if (is_file($staticFilePath)) {
                return $staticFilePath;
            }
        }


		// $fp = fopen('/tmp/data.txt', 'w');
		// fwrite($fp, "---> $uri \n");
		// fclose($fp);
		

		// https://workzen.dev/c/155-category_default/achats-et-services.jpg
		// --> 
		// https://workzen.dev/img/c/155.jpg
        if (preg_match('/c\/([0-9]*)-category_default\/.*\.jpg/', $uri, $matches)) {

            $staticFilePath = "{$sitePath}/img/c/{$matches[1]}.jpg";


            if (is_file($staticFilePath)) {
                return $staticFilePath;
            }

        }
        

        return false;
    }

    /**
     * Get the fully resolved path to the application's front controller.
     *
     * @param  string $sitePath
     * @param  string $siteName
     * @param  string $uri
     *
     * @return string
     */
    public function frontControllerPath($sitePath, $siteName, $uri)
    {


        if (preg_match('/(.*)modules(.*)/', $uri)) 
        {
            return $sitePath .= $uri;
        } 


        if (preg_match('/(.*)cyril15(.*)/', $uri)) 
        {
            // die('admin');
            $sitePath .= '/cyril15';
        } 

        // return $sitePath . $uri . '/index.php';

        $_SERVER['SCRIPT_FILENAME'] = $sitePath . '/index.php';
        return $sitePath . '/index.php';
    }
}
