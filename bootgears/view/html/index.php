<?php 
	require_once dirname(__FILE__).'/layout.php';
	
	layoutHeader('Start', View::baseUrl());
	
	echo '<div class="jumbotron">';
		echo '<div class="container">';
			echo '<h1>Codebot</h1>';
			echo '<p>Ensine e aprenda programação. Ponto.</p>';
		echo '</div>';
	echo '</div>';
	
	echo '<div class="container">';
		echo '<div class="row">';
			echo '<div class="col-md-4 index-hero1">';
				echo '<h2>Planejado</h2>';
				echo '<p>Um ambiente criado desde o princípio com foco no ensino de programação.</p>';
			echo '</div>';
			
			echo '<div class="col-md-4 index-hero2">';
				echo '<h2>Dados na núvem</h2>';
				echo '<p>Códigos e programas são armazenados e rodados na núvem.</p>';
			echo '</div>';
			
			echo '<div class="col-md-4 index-hero3">';
				echo '<h2>Expansível</h2>';
				echo '<p>Novas linguanges de programação podem ser acopladas facilmente.</p>';
			echo '</div>';
		echo '</div>';
		
		$aBaseUrl = View::baseUrl();
		
		echo '<hr class="featurette-divider">';

		echo '<div class="featurette">';
			echo '<img class="featurette-image pull-left" src="'.$aBaseUrl.'/img/feature_ide.jpg">';
			echo '<h2 class="featurette-heading">Codifique e teste. <span class="muted">No navegador.</span></h2>';
			echo '<p class="lead">Um ambiente de desenvolvimento completo, disponível através do browser: editor, terminal, compilação, o que for necessário.</p>';
			echo '<p class="lead">Programe na universidade, em casa, ou qualquer lugar usando as mesmas ferramentas. Tudo salvo automaticamente e disponível onde você estiver.</p>';
		echo '</div>';
		
		echo '<hr class="featurette-divider">';

		echo '<div class="featurette">';
			echo '<img class="featurette-image pull-right" src="'.$aBaseUrl.'/img/feature_challenges.jpg">';
			echo '<h2 class="featurette-heading">Desafios e Tarefas. <span class="muted">Por nível de dificuldade.</span></h2>';
			echo '<p class="lead">Resolva desafios categorizados por assunto e nível de dificuldade. Professores podem criar desafios novos a qualquer momento.</p>';
			echo '<p class="lead">Um desafio pode ser público (visível para todos) ou pridado (visível apenas pelo grupo no qual está disponível).</p>';
		echo '</div>';
		
		echo '<hr class="featurette-divider">';

		echo '<div class="featurette">';
			echo '<img class="featurette-image pull-left" src="'.$aBaseUrl.'/img/feature_incode_review.jpg">';
			echo '<h2 class="featurette-heading">Feedback. <span class="muted">Contextualizado no código.</span></h2>';
			echo '<p class="lead">O código do aluno e o feedback dado pelo professor são visualizados no mesmo contexto. Feedback junto ao código, porém sem modificá-lo.</p>';
		echo '</div>';
		
	echo '</div>';
	
	layoutFooter(View::baseUrl());
?>