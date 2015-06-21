<div class="titulo">Professores</div>
<div class="professores">
    <ul>
    <?php foreach($professores as $e) {
    	if ($e->url != '') {
    		echo "<li><a target=\"_blank\" href='http://".$e->url."'>".$e->Nome."&nbsp;-&nbsp;[Lates]</a></i></li>";
    	} else {
    		echo "<li>".$e->Nome."</li>";
    	}
    } ?>
    </ul>
</div>
