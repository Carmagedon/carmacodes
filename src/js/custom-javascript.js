/**!
 * CARMA
 */
jQuery( document ).ready(function( $ )
{
	jQuery(window).on('hashchange', function() {
		var hash = window.location.hash;
		jQuery('.menu-item .nav-link').closest('li').removeClass('active-hash');
		jQuery('.menu-item a[href="' + hash + '"].nav-link').closest('li').addClass('active-hash');
	});

	//balanceText('.balance-text > p',{watch: true});
	balanceText('main p',{watch: true});


	$('.contact-form .close').on('click',function(e){
		e.preventDefault();
		$(this).parent().hide();
	})

	$('.contact-form').on('submit',function(e)
	{
		$('.contact-form-response').removeClass('chip-suc','chip-err');
		e.preventDefault();
		if($(this)[0].checkValidity())
		{
			$.ajax({
				type: "POST",
				url: ajax_object.ajaxurl,
				data: $('.contact-form').serialize(),
				success: function( response ) {

					var chip = $('.contact-form-response');
					var chipText = $('.contact-form-response .chip-text');

					if(response == 'ok')
					{
						chipText.html(ajax_object.suctext);
						chip.addClass('chip-suc');
						$('.contact-form #email').val('').removeClass('valid');
						$('.contact-form label[for="email"]').removeClass('active');
						$('.contact-form #first_name_last_name').val('').removeClass('valid');
						$('.contact-form label[for="first_name_last_name"]').removeClass('active');
						$('.contact-form #subject').val('').removeClass('valid');
						$('.contact-form label[for="subject"]').removeClass('active');
						$('.contact-form #message').val('').removeClass('valid');
						$('.contact-form label[for="message"]').removeClass('active');
					}
					if(response == 'err')
					{
						chipText.html(ajax_object.errtext);
						chip.addClass('chip-err');
					}
				},
				error: function( response ){
					var chip = $('.contact-form-response');
					var chipText = $('.contact-form-response .chip-text');
					chipText.html(ajax_object.errtext);
					chip.addClass('chip-err');
				}
			});
		}
		$('.contact-form').addClass('was-validated');
		});

	var $grid = $('.pf-grid').isotope();

	$('.filter-btn-group').on( 'click', 'button', function() {
		var filterValue = $( this ).attr('data-filter');
		$('.filter-btn-group button').removeClass('active');
		$(this).addClass('active');
		$grid.isotope({ filter: filterValue });
	});


	var homeLink = $('link[rel="canonical"]').attr('href');
	var anchorlinks = $("a[href^='#'], a[href^='"+homeLink+"#']");
	anchorlinks.each(function(i,el)
	{
		$(el).on('click',function (e) {
			e.preventDefault();
			var hashval = $(el).attr('href');
			if(hashval !== undefined)
			{
				hashval = hashval.split('#')[1]
				hashval = '#'+hashval;
			}
			var target = $(hashval)[0];
			var isNavLink = $(el).hasClass('nav-link');
			var isMobileNavLink = $(el).hasClass('mobile-menu__item');
			if(target !== undefined)
			{
				target.scrollIntoView({
					behavior: 'smooth',
					block: 'start'
				});
				if(isNavLink)
				{
					$('.sidenav .menu-item').removeClass('active-hash')
					$(el).parent().addClass('active-hash')
				}
				if(isMobileNavLink)
				{
					$('.mobile-menu .mobile-menu__item').removeClass('mobile-menu__item-active')
					$(el).addClass('mobile-menu__item-active')
				}

			}

			history.pushState(null, null, hashval)
			e.preventDefault()
		})
	});
});