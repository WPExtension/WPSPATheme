# WPSPATheme
WordPress SPA Theme alternative of MVC Extension of the client wants work inside the theme

```PHP
   SPA Folder Structure
   > Themes
     > YourTheme
       > init
         > initActions

```

```PHP
   // functions.php theme file
   # Register new action!
       add_action('init', function() { ___initActions('initActions'); });

    function ___initActions( $___directories = null , bool $sc = false ) : void{

      $___initActions =  new Class( $___directories , $sc )  {

       public $dir;
       public $stype;

      protected function __construct( $___directories,  $sc)
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
                
              if (!$appRequest->isDot() && $this->stype != true ) {  
                require ( $___spa_directory . $appRequest->getFilename() ); } 
              else if (!$appRequest->isDot() && $this->stype == true ) { 
                require_once( $___spa_directory . $appRequest->getFilename() ); 
              } 

            }
      
        }   
     };     
  }

```

<h2>Hooks</h2>

```PHP
 
 # init_directory : Replace default init file_name folder for the main SPA structure
 # From folder named: init
 # To newDirectory

 // Usage: 
 add_filter('init_directory', function() {
   return 'newDirectory';
 }); 

```



