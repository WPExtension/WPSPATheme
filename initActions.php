<?php 

/**
 * @copyright (c) 2023 SPA WordPress Actions for Theme Cooked by nielsoffice 
 *
 *  GPL-2.0+ License
 *
 * PHPWine\VanillaFlavour v1.4.0.0 free software: you can redistribute it and/or modify.
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in all
 * copies or substantial portions of the Software.
 * 
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
 * SOFTWARE.
 *
 * @category   PHP MVC Framework for WordPress 
 * @package    Plugin boilterplate by  wpbb.me
 *            
 *            
 * @author    Leinner Zednanref <nielsoffice.wordpress.php@gmail.com>
 * @license    GPL-2.0+ License
 * @link      https://github.com/WPExtension/WPSPATheme
 * @link      https://github.com/WPExtension/WPSPATheme/blob/main/README.txt
 * @link      https://linktree.com/nielsoffice
 * @version   v1.0.0
 * @since     09.13.2023
 *
 */

    function ___initActions( $___directories = null , bool $sc = false ) : void{

      $___initActions =  new Class( $___directories , $sc )  {

       public $dir;
       public $stype;

      public function __construct( $___directories,  $sc)
      {

        $this->stype = $sc;
        $this->wp_check_compare_directory($___directories);

      }

      protected function wp_check_default_directory($spa) {
         return get_theme_file_path('init/' . $spa);
      }
      
      protected function wp_check_filtered_directory($spa)  {
        $filter_init = apply_filters( 'init_directory', "init" );
        return get_theme_file_path($filter_init . "/".$spa."/");
      }
      
      protected function handler_error( $hookDeault = [] ) {
        print "<span style='background-color: #F5D9D9; color: #333; '>";
        $container = [];  foreach($hookDeault as $hd) {
          $container[] = "Directory " .$hd."<br />";
        }
        print implode("", $container);
        print "</span>";

      }

      private function wp_check_compare_directory($spa)  {
          
        $hookDeault     = str_replace($spa, "", $this->wp_check_default_directory($spa));
        $hookedFiltired = str_replace($spa, "", $this->wp_check_filtered_directory($spa)); 
               
        if( file_exists($hookedFiltired)  ) {
          $___spa_directory = $this->wp_check_filtered_directory($spa);
        } else if( ($hookDeault !== $hookedFiltired)  ) {
                    
          $this->handler_error( [$hookDeault, $hookedFiltired] );
          print( 'Folder dictory name ' .$spa . ' NOT Found!' ); 
          exit;
                       
        } else {
            $___spa_directory = $this->wp_check_default_directory($spa);
        }
      
            $___spaAllRun = new DirectoryIterator( $___spa_directory );  
            foreach ($___spaAllRun as $appRequest) {  
      			
               $__filen = preg_replace('/\s+/', '', ($___spa_directory . $appRequest->getFilename()) );
               if (!$appRequest->isDot() && $this->stype != true ) {  	 
               require ($__filen); } 
               else if (!$appRequest->isDot() && $this->stype == true ) { 
               require_once($__filen); 
               } 
      
      	   }
      
        }   
     };     
     
  }
