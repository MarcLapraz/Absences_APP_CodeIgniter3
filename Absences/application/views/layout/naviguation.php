<header>
	<div class="container-fluid">
    <!-- Second navbar for categories -->
    <nav class="navbar navbar-default">
      <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse-1">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button> 
         <a href="http://www.esne.ch" class="navbar-left"><img src="<?php echo base_url();?>assets/images/esne.png"></a>
	   </div>
   
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="navbar-collapse-1">
          <ul class="nav navbar-nav navbar-left">
            <li><a href="<?php echo base_url();?>index.php/Absence_Controller">Absences</a></li>
            <li><a href="<?php echo base_url();?>index.php/Classe_Controller">Classes</a></li>
            <li><a href="<?php echo base_url();?>index.php/Eleve_Controller">Eleves</a></li>
            <li><a href="<?php echo base_url();?>index.php/Matiere_Controller">Matières</a></li>
            <li><a href="<?php echo base_url();?>index.php/Module_Controller">Modules</a></li>
            <li><a href="<?php echo base_url();?>index.php/Fiche_Controller">Fiche élève</a></li> 
			<li><a href="#">Tableau présence</a></li>     
			<li><a href="#">Fiche Matière</a></li>     
          </ul>
        
        </div><!-- /.navbar-collapse -->
      </div><!-- /.container -->
    </nav><!-- /.navbar -->
	</div>
</header>