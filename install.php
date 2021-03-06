<?php
#define('DISALLOW_FILE_EDIT', true );
// Acesso ao objeto global de gestão de bases de dados
global $wpdb, $wpcvp;

// Vamos checar se a nova tabela existe
// A propriedade prefix é o prefixo de tabela escolhido na
// instalação do WordPress


	// Se a tabela não existe vamos criá-la


  if ( $wpdb->get_var( "SHOW TABLES LIKE '".BD_CURRICULO."'" ) != BD_CURRICULO ) {	  
  
	  $sql = "
			
			CREATE TABLE ".BD_CURRICULO."(
				  id 			int(11) 		NOT NULL AUTO_INCREMENT,
				  id_area 		int(11) 		DEFAULT NULL,
				  nome 			varchar(255) 	COLLATE latin1_bin DEFAULT NULL,
				  cpf 			varchar(255) 	COLLATE latin1_bin DEFAULT NULL,
				  telefone 		varchar(255) 	COLLATE latin1_bin DEFAULT NULL,
				  celular 		varchar(255) 	COLLATE latin1_bin DEFAULT NULL,
				  email 		varchar(255) 	COLLATE latin1_bin DEFAULT NULL,
				  site_blog 	varchar(255) 	COLLATE latin1_bin DEFAULT NULL,
				  skype 		varchar(255) 	COLLATE latin1_bin DEFAULT NULL,
				  estado_civil 	varchar(255) 	COLLATE latin1_bin DEFAULT NULL,
				  idade 		varchar(255) 	COLLATE latin1_bin DEFAULT NULL,
				  sexo 			int(11) 		DEFAULT NULL,
				  remuneracao 	varchar(255) 	COLLATE latin1_bin DEFAULT NULL,
				  
				  login 		varchar(255) 	COLLATE latin1_bin DEFAULT NULL,
				  senha 		varchar(255) 	COLLATE latin1_bin DEFAULT NULL,
				  
				  rua 			varchar(255) 	COLLATE latin1_bin DEFAULT NULL,
				  numero 		varchar(255) 	COLLATE latin1_bin DEFAULT NULL,
				  bairro 		varchar(255) 	COLLATE latin1_bin DEFAULT NULL,
				  cidade 		varchar(255) 	COLLATE latin1_bin DEFAULT NULL,
				  estado 		varchar(255) 	COLLATE latin1_bin DEFAULT NULL,
				  cep 			varchar(255) 	COLLATE latin1_bin DEFAULT NULL,
				  
				  curriculo 	varchar(255) 	COLLATE latin1_bin DEFAULT NULL,
				  
				  descricao 	text 			COLLATE latin1_bin,
				  status 		int(11) 		NOT NULL DEFAULT '0',					

				  PRIMARY KEY (id)
			)";
  }  
		
  if ( $wpdb->get_var( "SHOW TABLES LIKE '".BD_AREA_SERVICOS."'" ) != BD_AREA_SERVICOS ) {	  		  
	
	$sql1 = "
	
		CREATE TABLE ".BD_AREA_SERVICOS." (
			id	 	int(11) 		NOT NULL AUTO_INCREMENT,
			area 	varchar(255) 	COLLATE latin1_bin DEFAULT NULL,
			PRIMARY KEY (id)
		)";
		
  }
	
  if ( $wpdb->get_var( "SHOW TABLES LIKE '".BD_CONFIGURACOES."'" ) != BD_CONFIGURACOES ) {	  		  
	
	$sql2 = "
	
		CREATE TABLE ".BD_CONFIGURACOES." (
			id 						int(11) 		NOT NULL AUTO_INCREMENT,
			assunto_cadastro 		varchar(255) 	COLLATE latin1_bin DEFAULT NULL,
			mensagem_cadastro 		text 			COLLATE latin1_bin,
			assunto_cadastro_admin 	varchar(255) 	COLLATE latin1_bin DEFAULT NULL,
			mensagem_cadastro_admin text 			COLLATE latin1_bin,
			assunto_aprovacao 		varchar(255) 	COLLATE latin1_bin DEFAULT NULL,
			mensagem_aprovacao 		text 			COLLATE latin1_bin,
			assunto_esqueceu 		varchar(255) 	COLLATE latin1_bin DEFAULT NULL,
			mensagem_esqueceu 		text 			COLLATE latin1_bin,
			
			emails_recebimento 		text 			COLLATE latin1_bin,
			tipo_envio 				int(11) 		DEFAULT '0',
			email 					varchar(255) 	COLLATE latin1_bin DEFAULT NULL,
			nome 					varchar(255) 	COLLATE latin1_bin DEFAULT NULL,
			usuario 				varchar(255) 	COLLATE latin1_bin DEFAULT NULL,
			senha 					varchar(255) 	COLLATE latin1_bin DEFAULT NULL,
			smtp_autententicacao 	int(11) 		DEFAULT '0',
			seguranca 				varchar(255) 	COLLATE latin1_bin DEFAULT NULL,
			porta_saida 			varchar(255) 	COLLATE latin1_bin DEFAULT NULL,
			host 					varchar(255) 	COLLATE latin1_bin DEFAULT NULL,
			PRIMARY KEY (id)
		)";
		
	
  }


  
  
  		$sqlOp = "SELECT * FROM ".BD_CONFIGURACOES." where id=1";
		
		$queryOp = $wpdb->get_results( $sqlOp, ARRAY_A );
		
		foreach($queryOp as $kOp => $vOp){
			$dadosOp = $vOp;
		}
		
		if($dadosOp['id'] == ""){
			
			$assunto_cadastro 			= "Seu currículo foi cadastrado com sucesso!";
			$mensagem_cadastro 			= "Seu Currículo foi cadastrado com sucesso,<br/>\n e assim que com pagamento for aprovado você receberá os dados de login de acesso.";
			
			$assunto_cadastro_admin 	= "Novo currículo cadastrado";
			$mensagem_cadastro_admin 	= "Nome: @nome <br/>
			Área de serviço: @area";
			
			$assunto_aprovado			= "Seu currículo foi aprovado!";
			$mensagem_aprovado			= "Seu currículo foi aprovado";
			
			$assunto_esqueceu			= "Nova senha foi gerada";
			$mensagem_esqueceu			= "Olá @nome, tudo bem?\n<br/>
			
			Sua nova senha é: @senha";
			
			$varOptions = array(
			  'assunto_cadastro' 		=> $assunto_cadastro,
			  'mensagem_cadastro' 		=> $mensagem_cadastro,
			  'assunto_cadastro_admin' 	=> $assunto_cadastro_admin,
			  'mensagem_cadastro_admin' => $mensagem_cadastro_admin,
			  'assunto_aprovacao'		=> $assunto_aprovado,
			  'mensagem_aprovacao'		=> $mensagem_aprovado,		  
			  'assunto_esqueceu'		=> $assunto_esqueceu,
		      'mensagem_esqueceu'		=> $mensagem_esqueceu,		  
			);
			
			$wpdb->insert(BD_CONFIGURACOES, $varOptions );
		}
  
  		
  
  if ( $wpdb->get_var( "SHOW TABLES LIKE '".BD_FORMA_ACADE."'" ) != BD_FORMA_ACADE ) {	  		  
	
	$sql3 = "
	
		CREATE TABLE ".BD_FORMA_ACADE." (
		  id 						int(11) 		NOT NULL AUTO_INCREMENT,
		  id_cadastro 				int(11) 		NOT NULL,
		  status 					int(11) 		NOT NULL,
		  subtitulo 				varchar(255) 	COLLATE latin1_bin DEFAULT NULL,
		  iniciou 					varchar(255) 	COLLATE latin1_bin DEFAULT NULL,
		  finalizou 				varchar(255) 	COLLATE latin1_bin DEFAULT NULL,
		  escola_faculdade 			varchar(255) 	COLLATE latin1_bin DEFAULT NULL,
		  formacao 					varchar(255) 	COLLATE latin1_bin DEFAULT NULL,
		  cidade_escola_faculdade 	varchar(255) 	COLLATE latin1_bin DEFAULT NULL,
		  estado_escola_faculdade 	varchar(255) 	COLLATE latin1_bin DEFAULT NULL,
		  edit 						int(11) 		NOT NULL DEFAULT '1',
		  
		  PRIMARY KEY (id)
		)";
  }
	
  if ( $wpdb->get_var( "SHOW TABLES LIKE '".BD_EXPERI_PROFIS."'" ) != BD_EXPERI_PROFIS ) {	  		  
  
	$sql4 = "
 
		CREATE TABLE ".BD_EXPERI_PROFIS." (
		  id 				int(11) 		NOT NULL AUTO_INCREMENT,
		  id_cadastro 		int(11) 		NOT NULL,
		  empresa 			varchar(255) 	COLLATE latin1_bin DEFAULT NULL,
		  ano_inicio 		varchar(255) 	COLLATE latin1_bin DEFAULT NULL,
		  ano_final 		varchar(255) 	COLLATE latin1_bin DEFAULT NULL,
		  cargo 			varchar(255) 	COLLATE latin1_bin DEFAULT NULL,
		  protocolo_site	varchar(255) 	default NULL,
		  site_empresa 		varchar(255) 	COLLATE latin1_bin DEFAULT NULL,
		  mais_cargo 		longtext 		COLLATE latin1_bin,
		  status_ep 		int(11) 		NOT NULL,
		  edit 				int(11) 		NOT NULL DEFAULT '1',
		  PRIMARY KEY (id)
		)";
		
  }
	
  if ( $wpdb->get_var( "SHOW TABLES LIKE '".BD_CURSOS_PALEST."'" ) != BD_CURSOS_PALEST ) {	
	
	$sql5 = "
	
		CREATE TABLE ".BD_CURSOS_PALEST." (
		  id 				int(11) 		NOT NULL AUTO_INCREMENT,
		  curso_palestra 	varchar(255) 	COLLATE latin1_bin DEFAULT NULL,
		  escola 			varchar(255) 	COLLATE latin1_bin DEFAULT NULL,
		  ano 				varchar(255) 	COLLATE latin1_bin DEFAULT NULL,
		  horas 			varchar(255) 	COLLATE latin1_bin DEFAULT NULL,
		  tipo 				int(11) 		DEFAULT NULL,
		  id_cadastro 		int(11) 		NOT NULL,
		  edit 				int(11) 		NOT NULL DEFAULT '1',
		  PRIMARY KEY (id)
		)";
		
  }

  if ( $wpdb->get_var( "SHOW TABLES LIKE '".BD_IDIOMAS."'" ) != BD_IDIOMAS ) {	
	
	$sql7 = "
	
		CREATE TABLE ".BD_IDIOMAS." (
		  id 				int(11) 		NOT NULL AUTO_INCREMENT,
		  iInicio 			varchar(255) 	COLLATE latin1_bin DEFAULT NULL,
		  iFinal 			varchar(255) 	COLLATE latin1_bin DEFAULT NULL,
		  iEscola 			varchar(255) 	COLLATE latin1_bin DEFAULT NULL,
		  iCurso 			varchar(255) 	COLLATE latin1_bin DEFAULT NULL,
		  iNivel			varchar(255) 	COLLATE latin1_bin DEFAULT NULL,
		  iDescricao 		longtext 		COLLATE latin1_bin,
		  iCursando 		int(11) 		NOT NULL,
		  id_cadastro 		int(11) 		NOT NULL,
		  edit 				int(11) 		NOT NULL DEFAULT '1',
		  PRIMARY KEY (id)
		)";
		
  }

  if ( $wpdb->get_var( "SHOW TABLES LIKE '".BD_CONHECI_TECNI."'" ) != BD_CONHECI_TECNI ) {	
	
	$sql8 = "
	
		CREATE TABLE ".BD_CONHECI_TECNI." (
		  id 				int(11) 		NOT NULL AUTO_INCREMENT,
		  ctCurso 			varchar(255) 	COLLATE latin1_bin DEFAULT NULL,
		  ctNivel 			longtext 		COLLATE latin1_bin,
		  id_cadastro 		int(11) 		NOT NULL,
		  edit 				int(11) 		NOT NULL DEFAULT '1',
		  PRIMARY KEY (id)
		)";
		
  }


	
	$sql6 = " 	
		CREATE TABLE ".BD_CURRICULO." 			LIKE wls_curriculo;
		CREATE TABLE ".BD_AREA_SERVICOS." 		LIKE wls_areas;
		CREATE TABLE ".BD_CONFIGURACOES." 		LIKE wls_curriculo_options;
		CREATE TABLE ".BD_FORMA_ACADE." 		LIKE wls_formacao_academica;
		CREATE TABLE ".BD_EXPERI_PROFIS." 		LIKE wls_experiencia_profissional;
		CREATE TABLE ".BD_CURSOS_PALEST." 		LIKE wp_wls_cursos_palestras;
	";
			
				
  // Para usarmos a função dbDelta() é necessário carregar este ficheiro
  require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );

  // Esta função cria a tabela na base de dados e executa as otimizações
  // necessárias.
  dbDelta( $sql );
  dbDelta( $sql1 );
  dbDelta( $sql2 );
  dbDelta( $sql3 );
  dbDelta( $sql4 );
  dbDelta( $sql5 );
  dbDelta( $sql6 );
  dbDelta( $sql7 );
  dbDelta( $sql8 );



  	/**
  	 * Cria as colunas necessárias
  	 * para a nova versão
  	 */
	function updateDataBase()
	{	
		global $wpdb;

		// 'NEW' Column
		// $column_new = $wpdb->get_results( "SELECT new FROM INFORMATION_SCHEMA.COLUMNS WHERE table_name = '".BD_CURRICULO."' AND column_name = 'new'"  );
		$column_new = $wpdb->get_results( "SELECT new FROM ".BD_CURRICULO." LIMIT 1"  );

		if(empty($column_new)){
			
			function column_new_created_successfuly() {
			    ?>
			    <div class="notice notice-success is-dismissible">
			        <p><?php _e( 'A coluna "new" não existie! Tentando criar... <br/><small>Note que agora todos os currículos existentes aparecerão com a label NEW, inclusive os já visualizados...</small>' ); ?></p>
			    </div>
			    <?php
			}
			
			add_action( 'admin_notices', 'column_new_created_successfuly' );
		    $wpdb->query("ALTER TABLE ".BD_CURRICULO." ADD new BOOLEAN NOT NULL DEFAULT TRUE");
		};


		// ALTER TABLE `alp_wls_curriculo` ADD `created_at` DATETIME NOT NULL DEFAULT 0;
		// UPDATE `alp_wls_curriculo` SET `created_at` = CURRENT_TIMESTAMP;

		// ALTER TABLE `alp_wls_curriculo` ADD `updated_at` DATETIME NOT NULL on update 1;
		// UPDATE `alp_wls_curriculo` SET `updated_at` = CURRENT_TIMESTAMP;


		// 'CREATED_AT' Column
		// $column_created_at = $wpdb->get_results( "SELECT created_at FROM INFORMATION_SCHEMA.COLUMNS WHERE table_name = '".BD_CURRICULO."' AND column_name = 'created_at'"  );
		$column_created_at = $wpdb->get_results( "SELECT created_at FROM ".BD_CURRICULO." LIMIT 1" );


		if(empty($column_created_at)){

			$wpdb->query("ALTER TABLE ".BD_CURRICULO." ADD created_at DATETIME DEFAULT NULL"); // some database dont acpts current_timestamp
			// $wpdb->query("ALTER TABLE ".BD_CURRICULO." ADD created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP"); //TRY
			
			// veja enviarCadastro.php:148
			// $wpdb->query("UPDATE `".BD_CURRICULO."` SET `created_at` = CURRENT_TIMESTAMP");

			$test_created_at = $wpdb->get_results( "SELECT created_at FROM ".BD_CURRICULO." LIMIT 1" ); // Check again

			if(!empty($test_created_at)){
				function column_created_at_created_successfuly() {
				    ?>
				    <div class="notice notice-success is-dismissible">
				        <p><?php _e( 'A coluna "created_at" não existia, mas foi criada com sucesso!' ); ?></p>
				    </div>
				    <?php
				}
				add_action( 'admin_notices', 'column_created_at_created_successfuly' );
			};
				
		};

		// 'UPDATED_AT' Column
		// $column_updated_at = $wpdb->get_results( "SELECT updated_at FROM INFORMATION_SCHEMA.COLUMNS WHERE table_name = '".BD_CURRICULO."' AND column_name = 'updated_at'"  );
		$column_updated_at = $wpdb->get_results( "SELECT updated_at FROM ".BD_CURRICULO." LIMIT 1"  );


		if(empty($column_updated_at)){


			$wpdb->query("ALTER TABLE ".BD_CURRICULO." ADD updated_at DATETIME DEFAULT NULL"); // some database dont acpts current_timestamp
			// $wpdb->query("ALTER TABLE ".BD_CURRICULO." ADD updated_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP"); //TRY
			
			// veja enviarCadastro.php:163
			// $wpdb->query("UPDATE `".BD_CURRICULO."` SET `updated_at` = CURRENT_TIMESTAMP"); 
			
			// Check again
			$test_updated_at = $wpdb->get_results( "SELECT updated_at FROM ".BD_CURRICULO." LIMIT 1"  );
			if(!empty($test_updated_at)){
				function column_updated_at_created_successfuly() {
				    ?>
				    <div class="notice notice-success is-dismissible">
				        <p><?php _e( 'A coluna "updated_at" não existia, mas foi criada com sucesso!' ); ?></p>
				    </div>
				    <?php
				}
				add_action( 'admin_notices', 'column_updated_at_created_successfuly' );
			};

		};

	}

	updateDataBase();

  
	$upload = wp_upload_dir();
	$upload_dir = $upload['basedir'];
	$upload_dir = $upload_dir . '/curriculos';
  
  if (! is_dir($upload_dir)) {
	 mkdir( $upload_dir, 0777 );
  }

//}
