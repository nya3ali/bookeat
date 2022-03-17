<!-- terms-conditions.php -->
<?php include 'dbCon.php'; ?>
<?php include 'template/header.php'; ?>

<body>

	<?php include 'template/nav-bar.php'; ?>
	<?php include 'template/search-header.php'; ?>

	<section class="faq-section">
		<div class="container">
			<div class="row">
				<!-- ***** FAQ Start ***** -->
				<div class="col-md-6 offset-md-3">

					<div class="faq-title text-center pb-3">
						<h2>FAQ (in French)</h2>
					</div>
				</div>
				<div class="col-md-6 offset-md-3">
					<div class="faq" id="accordion">
						<div class="card">
							<div class="card-header" id="faqHeading-1">
								<div class="mb-0">
									<h5 class="faq-title" data-toggle="collapse" data-target="#faqCollapse-1" data-aria-expanded="true" data-aria-controls="faqCollapse-1">
										<span class="badge">1</span>Qu'est-ce que Book`EAT ?
									</h5>
								</div>
							</div>
							<div id="faqCollapse-1" class="collapse" aria-labelledby="faqHeading-1" data-parent="#accordion">
								<div class="card-body">
									<p>Book`Eat est un service de reservation de table en ligne, qui rassemble des centaines de restaurants.</p>
								</div>
							</div>
						</div>
						<div class="card">
							<div class="card-header" id="faqHeading-2">
								<div class="mb-0">
									<h5 class="faq-title" data-toggle="collapse" data-target="#faqCollapse-2" data-aria-expanded="false" data-aria-controls="faqCollapse-2">
										<span class="badge">2</span> Dans toute la France ?
									</h5>
								</div>
							</div>
							<div id="faqCollapse-2" class="collapse" aria-labelledby="faqHeading-2" data-parent="#accordion">
								<div class="card-body">
									<p>Pour le moment nos partenaires se situent seulement sur Montpellier, mais ne vous inquiétez pas, bientôt vous nous retrouverez près de chez vous !</p>
								</div>
							</div>
						</div>
						<div class="card">
							<div class="card-header" id="faqHeading-3">
								<div class="mb-0">
									<h5 class="faq-title" data-toggle="collapse" data-target="#faqCollapse-3" data-aria-expanded="false" data-aria-controls="faqCollapse-3">
										<span class="badge">3</span>Comment utiliser le site ?
									</h5>
								</div>
							</div>
							<div id="faqCollapse-3" class="collapse" aria-labelledby="faqHeading-3" data-parent="#accordion">
								<div class="card-body">
									<p>C'est simple pour cela il suffit de chercher un quartier ou un arrondissement dans la barre de recherche et une liste des restaurants partenaires apparaîtra, choisissez et Bookez !</p>
								</div>
							</div>
						</div>
						<div class="card">
							<div class="card-header" id="faqHeading-4">
								<div class="mb-0">
									<h5 class="faq-title" data-toggle="collapse" data-target="#faqCollapse-4" data-aria-expanded="false" data-aria-controls="faqCollapse-4">
										<span class="badge">4</span> Et les promos dans tout ça ?
									</h5>
								</div>
							</div>
							<div id="faqCollapse-4" class="collapse" aria-labelledby="faqHeading-4" data-parent="#accordion">
								<div class="card-body">
									<p>Nous ne vous oublions pas, nos partenaires offrent souvent des promotions à la reservation d'une table, régalez vous &#128523; !</p>
								</div>
							</div>
						</div>
						<div class="card">
							<div class="card-header" id="faqHeading-5">
								<div class="mb-0">
									<h5 class="faq-title" data-toggle="collapse" data-target="#faqCollapse-5" data-aria-expanded="false" data-aria-controls="faqCollapse-5">
										<span class="badge">5</span> Je suis un restaurateur et je souhaite devenir partenaire, comment faire ?
									</h5>
								</div>
							</div>
							<div id="faqCollapse-5" class="collapse" aria-labelledby="faqHeading-5" data-parent="#accordion">
								<div class="card-body">
									<p> Tout d'abord bienvenue à vous futur partenaire ! Vous souhaitez proposer votre restaurant et jouir d'un service de booking avec un panel admin personnel, c'est très simple pour se joindre à notre liste de partenaires, il suffit de passer par la page d'inscription, ensuite dans s'inscrire, l'onglet "Comme restaurant" et suivez les étapes.</p>
								</div>
							</div>
						</div>
						<div class="card">
							<div class="card-header" id="faqHeading-6">
								<div class="mb-0">
									<h5 class="faq-title" data-toggle="collapse" data-target="#faqCollapse-6" data-aria-expanded="false" data-aria-controls="faqCollapse-6">
										<span class="badge">6</span> Que proposez vous pour vos partenaires ?
									</h5>
								</div>
							</div>
							<div id="faqCollapse-6" class="collapse" aria-labelledby="faqHeading-6" data-parent="#accordion">
								<div class="card-body">
									<p>Nous avons un système de reservation rapide, simple et complet. Un panel admin avec la possibilité de gérer/modifier ou supprimer le nombre de table proposées, la gestion des menus proposés par le restaurant, la possibilité d'accépter ou de rejeter une reservation avec mail de confirmation automatique, gestion du profil restaurant et bien plus encore ! Alors n'hésitez plus et rejoignez nous !</p>
								</div>
							</div>
						</div>
						<div class="card">
							<div class="card-header" id="faqHeading-7">
								<div class="mb-0">
									<h5 class="faq-title" data-toggle="collapse" data-target="#faqCollapse-7" data-aria-expanded="false" data-aria-controls="faqCollapse-7">
										<span class="badge">7</span> J'ai d'autres questions ?
									</h5>
								</div>
							</div>
							<div id="faqCollapse-7" class="collapse" aria-labelledby="faqHeading-7" data-parent="#accordion">
								<div class="card-body">
									<p>Contactez-nous <span><a href="mailto:nada.localhost@gmail.com"> ici </a></span>, nous répondons généralement sous 48h.</p>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

	<?php include 'template/instagram.php'; ?>

	<?php include 'template/footer.php'; ?>

	<?php include 'template/script.php'; ?>
</body>