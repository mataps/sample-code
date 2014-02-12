<?php

return array(
	'admin' => array(
		'username' => 'admin',
		'password' => Hash::make('sm@rt2013')
	),
	'categories' => array(
		'Places to Go',
		'Food to Eat',
		'Activities to Enjoy',
		'People to Meet',
		'Plants and Animals to Discover',
		'History to Uncover',
		'Community Products to Support'
	),
	'category_slug' => array(
		'places-to-go',
		'food-to-eat',
		'activities-to-enjoy',
		'people-to-meet',
		'plants-and-animals-to-discover',
		'history-to-uncover',
		'community-products-to-support'
	),
	'media' => array(
		'path' => public_path().'/media',
		'types' => array(
			'images' => array(
				'image/png',
				'image/jpg',
				'image/tiff',
				'image/pjpeg',
				'image/gif',
				'image/jpeg'
			),
			'videos' => array(
				'video/mpeg',
				'video/mp4',
				'video/ogg',
				'video/quicktime',
				'video/webm',
				'video/x-matroska',
				'video/x-ms-wmv',
				'video/x-flv',
				'video/x-msvideo',
				'application/x-troff-msvideo',
				'video/avi',
				'video/msvideo',
				'video/MP2T',
				'video/3gpp',
				'application/x-mpegURL'
			)
		)
	),
	'mail' => array(
		'to' => 'smartschoolsprogram@gmail.com',
		'cc' => array(
			'lonel.labit@here.com',
			'feldalyn.mauleon@here.com',
			'dominador.sadernas@here.com',
			'pcofilada@gmail.com',
			'ragde@Mataps.ph',
			'agentp@Mataps.ph',
			'ryan@Mataps.ph'
		)
	),
	'form' => array(
		'regions' => array(
			''												=> 'Please select school region...',
			'National Capital Region (NCR; Metro Manila)'	=> 'National Capital Region (NCR; Metro Manila)',
			'Cordillera Administrative Region (CAR)'		=> 'Cordillera Administrative Region (CAR)',
			'Ilocos Region (Region I)'						=> 'Ilocos Region (Region I)',
			'Cagayan Valley (Region II)'					=> 'Cagayan Valley (Region II)',
			'Central Luzon (Region III)'					=> 'Central Luzon (Region III)',
			'CALABARZON (Region IV-A)'						=> 'CALABARZON (Region IV-A)',
			'MIMAROPA (Region IV-B)'						=> 'MIMAROPA (Region IV-B)',
			'Bicol Region (Region V)'						=> 'Bicol Region (Region V)',
			'Western Visayas (Region VI)' 					=> 'Western Visayas (Region VI)',
			'Central Visayas (Region VII)'					=> 'Central Visayas (Region VII)',
			'Eastern Visayas (Region VIII)'					=> 'Eastern Visayas (Region VIII)',
			'Zamboanga Peninsula (Region IX)'				=> 'Zamboanga Peninsula (Region IX)',
			'Northern Mindanao (Region X)'					=> 'Northern Mindanao (Region X)',
			'Davao Region (Region XI)'						=> 'Davao Region (Region XI)',
			'SOCCSKSARGEN (Region XII)'						=> 'SOCCSKSARGEN (Region XII)',
			'Caraga (Region XIII)'							=> 'Caraga (Region XIII)',
			'Autonomous Region in Muslim Mindanao (ARMM)' 	=> 'Autonomous Region in Muslim Mindanao (ARMM)'
		),
		'school_levels' => array(
			'' 			=> 'Please select school level...',
			'Primary' 	=> 'Primary',
			'Secondary' => 'Secondary'
		),
		'school_memberships' => array(
			'' 							=> 'Please selects school membership...',
			'SmartSchools Partner' 		=> 'SmartSchools Partner',
			'Non-SmartSchools Partner' 	=> 'Non-SmartSchools Partner'
		),
		'school_types' => array(
			'' 			=> 'Please select school type...',
			'Public' 	=> 'Public',
			'Private' 	=> 'Private'
		),
		'categories' => array(
			'' 									=> 'Please select category...',
			'Places to Go' 						=> 'Places to Go',
			'Food to Eat' 						=> 'Food to Eat',
			'Activities to Enjoy' 				=> 'Activities to Enjoy',
			'People to Meet' 					=> 'People to Meet',
			'Plants and Animals to Discover' 	=> 'Plants and Animals to Discover',
			'History to Uncover' 				=> 'History to Uncover',
			'Communities Products to Support' 	=> 'Community Products to Support'
		),
		'media_types' => array(
			''			=> 'Entry Format...',
			'Flip Book'	=> 'Flip Book',
			'Photo'		=> 'Photo',
			'Slideshow Presentation' => 'Slideshow Presentation',
			'Timeline' 	=> 'Timeline',
			'Video'  	=> 'Video'
		)
	)
);