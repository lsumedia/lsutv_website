<!doctype html>
<html>
    <head>
        <?php 
            $pagename = "search";
            $pagetitle = "LSUTV - Search";
            require_once("config.php");
            require("components/header.php"); 
        ?>
    </head>
    <body>
        <!-- Navigation section -->
        <?php require("components/nav.php"); ?>
        
        <?php
        $term = $_GET['term'];
        ?>
        
        <!-- Content section -->
       <main class="container" id="main-content">
            <div class="row">
               <div class="column s12">
                   <form action="" method="GET">
                       <nav class="nav-wrapper red lighten-1">
                       <div class="input-field">
                            <input id="search-bar" class="active" name="term" type="search" required value="<?= (trim($term) == '')? '' : $term ?>" placeholder="Search" >
                            <label for="search-bar"><i class="material-icons">search</i></label>
                       </div>
                       </nav>
                   </form>
               </div>
            </div>
               
            <div class="row" id="search-results">
                <?php
                //If term is not blank or whitespace
                if(strlen($term) > 0 && !(trim($term) == '')){
                    $api_url_s = $config['publicphp'] . '?action=plugin_vod&search=' . urlencode($term) . '&limit=100';
                    $results = json_decode(file_get_contents($api_url_s),1);

                    foreach($results as $index => $result){
                        ?>
                    <div class="col s12 m6 l3">
                        <div class="card small pointer z-depth-0">
                            <a href="./video?play=<?= $result['id'] ?>">
                            <div class="card-image z-depth-1">
                                <div class="video-container" style="background-image:url('<?= $result['poster'] ?>');"></div>
                            </div>
                            <div class="card-content">
                                <div class="search-result-title black-text"><?= $result['title'] ?></div>
                            </div>
                            <!-- <div class="card-title"><?= $result['title'] ?></div> -->
                            </a>
                        </div>
                    </div>
                    <?php
                    }
                }

                ?>
            </div>
        </main>
        <script>$("#search-bar").focus();</script>
        
        <?php require("components/footer.php"); ?>
           
    </body>
</html>