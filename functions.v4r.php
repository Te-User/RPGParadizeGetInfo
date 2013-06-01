<?php 
    class Server
     { 
        public $RPG_ID = 34329; 
        public $automaticalSave = true;
        public $cacheTimeMinute = 30;
        public $sourcePage;
        public $Name;
        public $Position;
        public $Vote;
        public $ClicOut;
        public $Site;
        public $Presentation;
        public $Logo;
        public $FBLike;
        public $FBComment;
        public $HistoryVote;
        public function __construct()   
        {   
            if((isset($_SESSION['v4r_time'])) AND (time() >= $_SESSION['v4r_time'])) {
              $_SESSION = array();
            }
            if((isset($_SESSION['v4r_save'])) AND ($this->automaticalSave)) {
                $this->sourcePage = $_SESSION['v4r_save'];
            } else {
                $this->sourcePage = file_get_contents('http://www.rpg-paradize.com/site--'.$this->RPG_ID);
                if($this->automaticalSave) {
                  $_SESSION['v4r_save'] = $this->sourcePage;
                  $_SESSION['v4r_time'] = time() + (60 * $this->cacheTimeMinute);
                }
            }
            $this->Name = $this->parseContent('overflow:hidden;">', '</h1>');   
            $this->Position = $this->parseContent("<b>Position ", "</b>");   
            $this->Vote = $this->parseContent("Vote : ", "</a>");   
            $this->Site = $this->parseContent(" target=_blank>", "</a>");   
            $this->ClicOut = $this->parseContent("Clic Sortant : ", "</td>");   
            $this->Presentation = $this->parseContent('style="width:700px;overflow:hidden;">', "</div>");   
            $this->Logo = $this->parseContent('<meta property="og:image" content="', '" />');   
            $this->FBLike = $this->parseContent('<td colspan=3 align=left><br><hr>', '<g:plusone>');  
            $this->HistoryVote = ('<script language="JavaScript" src="http://www.rpg-paradize.com/graph_swf/FusionCharts.js"></script><center><div id="chartdiv" align="center" style="height:150px;">Loading charts... </div></center><script type="text/javascript"> 
               var chart = new FusionCharts("http://www.rpg-paradize.com/graph_swf/FCF_MSLine.swf", "ChartId", "700", "150");
               chart.setDataURL("http://www.rpg-paradize.com/get_statvote.php?num_site='.$this->RPG_ID.'");
               chart.render("chartdiv");
            </script>');
            $this->FBComment = ('<script src="http://connect.facebook.net/fr_FR/all.js#appId=186268651409878&amp;xfbml=1"></script><fb:comments href="http://www.rpg-paradize.com/info_site-'.$this->RPG_ID.'" num_posts="100" width="715"></fb:comments>');
        } 
        public function parseContent($val1, $val2)
        {  
            $parser = explode($val1, $this->sourcePage);
            $parser2 = explode($val2, $parser[1]);
            return $parser2[0];
        }     
     } 
    $Server = new Server(); 
?>