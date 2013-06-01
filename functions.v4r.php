<?php 
    class Server
     { 
        public $RPG_ID = 34329; 
        public $sourcePage;
        public $Name;
        public $Position;
        public $Vote;
        public $ClicOut;
        public $Site;
        public $Presentation;
        public $Logo;
        public $FB;
        public $HistoryVote;

        public function __construct()   
        {   
            $this->sourcePage = file_get_contents('http://www.rpg-paradize.com/site--'.$this->RPG_ID);
            $this->Name = $this->parseContent('overflow:hidden;">', '</h1>');   
            $this->Position = $this->parseContent("<b>Position ", "</b>");   
            $this->Vote = $this->parseContent("Vote : ", "</a>");   
            $this->Site = $this->parseContent(" target=_blank>", "</a>");   
            $this->ClicOut = $this->parseContent("Clic Sortant : ", "</td>");   
            $this->Presentation = $this->parseContent('style="width:700px;overflow:hidden;">', "</div>");   
            $this->Logo = $this->parseContent('<meta property="og:image" content="', '" />');   
            $this->FB = $this->parseContent('<td colspan=3 align=left><br><hr>', '<g:plusone>');  
            $this->HistoryVote = ('<script language="JavaScript" src="http://www.rpg-paradize.com/graph_swf/FusionCharts.js"></script><center><div id="chartdiv" align="center" style="height:150px;">Loading charts... </div></center><script type="text/javascript"> 
               var chart = new FusionCharts("http://www.rpg-paradize.com/graph_swf/FCF_MSLine.swf", "ChartId", "700", "150");
               chart.setDataURL("http://www.rpg-paradize.com/get_statvote.php?num_site='.$this->RPG_ID.'");
               chart.render("chartdiv");
            </script>');
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