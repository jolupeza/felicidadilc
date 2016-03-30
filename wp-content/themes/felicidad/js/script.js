var j = jQuery.noConflict();
var map;

(function($) {
  var $body = j('body');
  var $footer = j('.footer');
  var $window = j(window);
  var URLactual = window.location.toString();

  var arrAsuntos = [
    'crédito con garantía de joyas de oro',
    'crédito con garantía de artículos',
    'crédito con garantía vehicular',
  ];

  var agencia = {};
  agencia.title = '';
  agencia.address = '';
  agencia.phone = '';
  agencia.latitud = '';
  agencia.longitud = '';
  agencia.horario1 = '';
  agencia.horario2 = '';
  agencia.horario3 = '';
  agencia.images = [];

  $window.resize(function(event){
    if($window.width() >= 768) {
      resizeVideo('640', '390');
    }

    if($window.width() < 768) {
      resizeVideo('426', '240');
    }

    if($window.width() < 400) {
      resizeVideo('100%', 'auto');
    }

    bottomFooter();
  });

  j(document).on("ready", function() {
    j.slidebars();

    bottomFooter();

    //activeTabService();

    // Change image hover links services home
    j('.main__services__service__figure').hover(function(){
      var $this = j(this);
      var imgNormal = $this.find('.img-normal');
      var imgHover = $this.find('.img-hover');

      imgNormal.addClass('hide');
      imgHover.removeClass('hide');
    }, function(){
      var $this = j(this);
      var imgNormal = $this.find('.img-normal');
      var imgHover = $this.find('.img-hover');

      imgNormal.removeClass('hide');
      imgHover.addClass('hide');
    });

    //For touch swipe carousels Bootstrap left and right
    j(".carousel-inner").swiperight(function() {
      j(this).parent().carousel('prev');
    });
    j(".carousel-inner").swipeleft(function() {
      j(this).parent().carousel('next');
    });

    //Funcionalidad mostrar y ocultar footer
    j('#js-footer').on('click', function(ev){
      ev.preventDefault();
      var footer = j('.footer');
      var heightBody = $body.outerHeight();
      var heightFooter = $footer.outerHeight();

      if ( footer.hasClass( 'active' ) )
      {
        footer.css('position', 'fixed');
        j(this).css('position', 'fixed');

        footer.animate({
          'bottom' : -heightFooter + 'px'
        }, 100);

        footer.removeClass( 'active' );
      }
      else
      {
        footer.css('position', 'relative');
        j(this).css('position', 'relative');

        footer.animate({
          'bottom' : '0'
        }, 0, function(){
          j('body, html').animate({
            scrollTop: heightBody
          }, 'slow');
        });

        footer.addClass('active');

        // $body.addClass('bgi');
      }
    });

    // Mostrar y ocultar promocion
    /*
    j('#js-promo').on('click', function(ev){
      ev.preventDefault();
      var $this = j(this);
      var $parent = $this.parent();
      var mr = '0';

      if ($parent.hasClass('visible'))
      {
        if ( j(window).width() < 1050)
        {
          mr = '-910px';
        }
        else
        {
          mr = '-960px';
        }
      }

      $parent.animate({
        'margin-right': mr
      }, 'slow', function(){
        if ( j(this).hasClass( 'visible' ))
        {
          j(this).removeClass( 'visible' );

          // Stop carousel promociones
          j('#carousel-promociones').carousel('pause');
        }
        else
        {
          j(this).addClass( 'visible' );

          // Start carousel promociones
          j('#carousel-promociones').carousel();
        }
      });
    });

    if ( _root_ === URLactual )
    {
      j('.sidebar-right__list__item--promo').addClass('visible');

      // Start carousel promociones
      j('#carousel-promociones').carousel();

      // Mostrar promocion por 10 segundo luego se oculta
      setTimeout(function(){
        if ( j(window).width() < 1050)
        {
          mr = '-910px';
        }
        else
        {
          mr = '-960px';
        }

        if ( j('#js-promo').parent().hasClass('visible') )
        {
          j('#js-promo').parent().animate({
            'margin-right': mr
          }, 'slow', function(){
            j(this).removeClass('visible');
          });
        }

        // Stop carousel promociones
        j('#carousel-promociones').carousel('pause');
      }, 2000);
    }
    */

    // Funcionalidad Collapse servicios Movil
    j('#accordion-info').on('show.bs.collapse', function(element){
      var $this = j(this);
      var now = element.target.id;
      $this.find('.panel-heading').removeClass('active');

      j('#' + now).prev().addClass('active');
    });

    // Modal Escribenos
    j('#js-escribenos').on('shown.bs.modal', function(event){
      j('#contact_name').focus();
    });

    j('#js-escribenos').on('show.bs.modal', function(event){
      var button = j(event.relatedTarget);
      var type = button.data('type');

      var modal = j(this);
      modal.find('.modal-ilc__title').html('<span>Formulario de ' + type + '</span>');

      if (type === 'Sugerencias')
      {
        modal.find('.fieldConsulta').hide();
      }

      modal.find('.js-frm-contact').data('type', type)
    });

    j('#js-escribenos').on('hide.bs.modal', function(e) {
      var modal = j(this);
      modal.find('.fieldConsulta').show();

      document.getElementById("js-frm-contact").reset();
      j('.js-frm-contact').data('formValidation').resetForm();

      j('.js-frm-text').removeClass('text-success text-danger').text('Completa el siguiente formulario y envianos tu consulta que nosotros gustosamente te responderemos.');
    });

    // Validaciones formularios de sección Escríbenos
    j('.js-frm-contact').formValidation({
      // To use feedback icons, ensure that you use Bootstrap v3.1.0 or later
      feedbackIcons: {
        valid: 'glyphicon glyphicon-ok',
        invalid: 'glyphicon glyphicon-remove',
        validating: 'glyphicon glyphicon-refresh'
      },
      live: 'enabled',
      fields: {
        contact_name: {
          validators: {
            notEmpty: {
                message: 'Campo requerido'
            },
            regexp: {
                regexp: /^[a-zA-ZñÑ\s\W]/,
                message: 'Sólo puede contener caracteres alfabeticos'
            }
          }
        },
        contact_email: {
          validators: {
            notEmpty: {
                message: 'Campo equerido'
            },
            emailAddress: {
                message: 'Email no es válido'
            }
          }
        },
        contact_dni: {
          validators: {
            notEmpty: {
              message: 'Campo requerido'
            },
            stringLength: {
              min: 8,
              max: 8,
              message: 'Debe contener 8 dígitos'
            },
            digits: {
              message: 'Debe contener valores numéricos'
            }
          }
        },
        contact_phone: {
          validators: {
            notEmpty: {
              message: 'Campo requerido'
            },
            stringLength: {
              min: 7,
              max: 12,
              message: 'Debe contener entre 7 y 12 dígitos'
            },
            digits: {
              message: 'Debe contener valores numéricos'
            }
          }
        },
        contact_dpto: {
          validators: {
            callback: {
              message: 'Seleccionar departamento',
              callback: function(value, validator) {
                if (value === '') {
                  return false;
                }

                return true;
              }
            }
          }
        },
        contact_message: {
          validators: {
            notEmpty: {
              message: 'Campo requerido'
            }
          }
        }
      },
    })
    .on('err.field.fv', function(e, data) {
        var field = e.target;
        j('small.help-block[data-bv-result="INVALID"]').addClass('hide');
    })
    .on('success.form.fv', function(e){
      e.preventDefault();

      j('.js-loader-contact').removeClass('hidden').addClass('show');

      var $this = j(this);
      var type  = $this.data('type');

      $this.find('p').remove();

      var $form = j(e.target);
      var dataArray = $form.serializeArray();

      var name    = dataArray[0].value;
      var email   = dataArray[1].value;
      var dni     = dataArray[2].value;
      var phone   = dataArray[3].value;
      var dpto    = dataArray[4].value;
      var message = dataArray[5].value;

      j.post(MyAjax.url, {
        nonce   : MyAjax.nonce,
        action  : 'send_email',
        type    : type,
        name    : name,
        email   : email,
        dni     : dni,
        phone   : phone,
        dpto    : dpto,
        message : message,
      }, function(data) {
        j('.js-loader-contact').removeClass('show').addClass('hidden');
        $this.data('formValidation').resetForm();

        var text = j('.js-frm-text');
        text.text('');

        if (data.result)
        {
          text.removeClass('text-danger').addClass('text-success').text('Has enviado con éxito el mensaje. Nos pondremos en contacto con usted tan pronto como sea posible.');
          document.getElementsByClassName("js-frm-contact")[0].reset();
          document.getElementsByClassName("js-frm-contact")[1].reset();
          // j('.js-frm-contact').data('formValidation').resetForm(true);
        }
        else
        {
          text.removeClass('text-success').addClass('text-danger').text('No podemos enviar el correo electrónico en este momento. Por favor, vuelva a intentarlo.');
        }
      }, 'json');
    });

    // Al cambiar de tab en movil modificamos el texto del formulario
    j('.BarContact a[data-toggle="tab"]').on('shown.bs.tab', function(e){
      j('.js-frm-text').removeClass('text-success text-danger').text('Completa el siguiente formulario para recibir información sobre cualquiera de nuestros servicios.');
    });

    /* -------------------------------------------------------------------------------------------------------------------- */
    // Funcionalidad Mapa Móvil
    j('.sel-map').on('change', function(ev){
      ev.preventDefault();

      var $this = j(this);
      var ciudad = $this.val();
      var distrito = 0;
      // var tag = 0;
      var page = 1;

      if (ciudad !== '' || ciudad.length > 0)
      {
        // Get Distritos and display in select
        j.post(MyAjax.url, {
          nonce    : MyAjax.nonce,
          action   : 'get_distritos',
          ciudad   : ciudad
        }, function(data) {
          var $selDistrito = j('.sel-distrito');
          var intro = '<option value="">-- Selecciona tu Distrito --</option>';

          if ( data.result )
          {
            generateSelDistritos( data.distritos, ciudad );
          }
          else
          {
            $selDistrito.html('').html(intro);
          }
        }, 'json');

        // Clear select type credit
        // j('.sel-tipo-credito').find('option').first().prop('selected', true);

        loadInfoMaps(ciudad, page, distrito);
        // loadInfoMaps(ciudad, page, distrito, tag);
      }
    });

    // FUncionalidad paginación mapas
    $body.on('click', '#js-pag-maps ul li a', function(ev){
      ev.preventDefault();

      var $this = j(this);
      var page  = $this.text();

      if ( page === '»' || page === '«' )
      {
        j("#js-pag-maps .page-numbers li").each( function(index, el) {
          if ( j(this).find('span.current').length )
          {
            var current = parseInt( j(this).find('span.current').text() );

            page = (page === '»') ? current + 1 : current - 1;
            return false;
          }
        });
      }

      var ciudad   = 0;
      var distrito = 0;
      // var tag      = 0;

      var url = $this.attr("href");
      url = url.replace("http://", "");

      url = url.split('/');

      if ( url[1] === 'tag' )
      {
        tag = parseInt( url[0] );
      }
      else if ( url[1] === 'distrito' )
      {
        distrito = parseInt( url[0] );
        Ciudad = parseInt( url[2] );
      }
      else
      {
        ciudad = parseInt( url[0] );
      }

      loadInfoMaps(ciudad, page, distrito);
      // loadInfoMaps(ciudad, page, distrito, tag);
    });

    j('#js-maps').on('shown.bs.modal', function(e){
      var button = j(e.relatedTarget);

      var info = button.data('info');

      if ( info.length > 0 )
      {
        info = info.split('|');

        agencia.title = info[0];
        agencia.address = info[1];
        agencia.phone = info[2];
        agencia.latitud = info[3];
        agencia.longitud = info[4];
        agencia.horario1 = info[5];
        agencia.horario2 = info[6];
        agencia.horario3 = info[7];
        agencia.images = (info[8].length > 0) ? info[8].split(',') : [];

        var content  = '<div id="mapInfo">'+
                        '<p><strong>' + agencia.title + '</strong><br />'+
                        agencia.address + '<br />' +
                        'Prendafono: ' + agencia.phone +
                        //'<a href="http://www.guggenheim.org/venice" target="_blank">Plan your visit</a>'+
                        '</div>';

        j('.map-info__title--agencia').text( agencia.title );
        j('.map-info__address').text( agencia.address );
        j('.map-info__phone').text( 'Prendafono: ' + agencia.phone );

        if ( agencia.horario1.length > 0 )
        {
          j('#js-modal-horario1').html('Lunes a Viernes: <span>' + agencia.horario1  + '</span>' );
        }

        if ( agencia.horario2.length > 0 )
        {
          j('#js-modal-horario2').html('Sábados: <span>' + agencia.horario2  + '</span>' );
        }

        if ( agencia.horario3.length > 0 )
        {
          j('#js-modal-horario3').html('Domingos y Feriados: <span>' + agencia.horario3 + '</span>' );
        }

        // Add images tab gallery images
        var contentGallery = j('.TabGallery-inner');
        var contentIndicators = j('.TabGallery-indicators');

        if ( agencia.images.length > 0 )
        {
          j.each(agencia.images, function(index, el) {
            var active = (index === 0) ? 'active' : '';

            var indicator = '<li data-target="#car-img-agencia" data-slide-to="' + index + '" class="' + active + '"></li>';

            var item = '<div class="item ' + active + ' TabGallery-item">'
                  + '<img class="img-responsive" src="' + el + '" alt="' + agencia.title + '" />'
                  + '</div><!-- end TabGallery-item -->';

            contentGallery.append(item);
            contentIndicators.append(indicator);
          });
        }
        else
        {
          var item = '<div class="item active TabGallery-item">'
                  + '<img class="img-responsive" src="http://lorempixel.com/546/206" />'
                  + '</div><!-- end TabGallery-item -->';

          contentGallery.append(item);
          j('.TabGallery-control').css('visibility', 'hidden');
        }

        // Load google map
        loadMap( agencia.latitud, agencia.longitud, 'js-map-container', content );

        var currentCenter = map.getCenter();
        google.maps.event.trigger(map, "resize");
        map.setCenter(currentCenter);
      }
    });

    // Get event tab gallery and start carousel
    j('a[aria-controls="gallery" ]').on('shown.bs.tab', function(e){
      j('#car-img-agencia').carousel();
    });

    // Hide modal info agencia reset data
    j('#js-maps').on('hidden.bs.modal', function(e){
      j('.map-info__title--agencia').text('');
      j('.map-info__address').text('');
      j('.map-info__phone').text('');
      j('#js-modal-horario1').html('');
      j('#js-modal-horario2').html('');
      j('#js-modal-horario3').html('');

      j('#js-map-container').html('');

      j('#car-img-agencia').carousel('pause');
      j('.TabGallery-inner').html('');
      j('.TabGallery-indicators').html('');
      j('.TabGallery-control').css('visibility', 'visible');

      // Active first tab Map
      j('.TabsAgencia li').removeClass('active').first().addClass('active');
      j('.TabsAgencia-content .tab-pane').removeClass('active').first().addClass('active');
    });

    // Paginación Agencias en Móvil
    j('.main__map__info').on('swiperight', function(){
      var nav = j('#js-pag-maps');
      var page = parseInt(nav.find('span.current').text());

      if ( page > 1 )
      {
        var ciudad = nav.find('a.page-numbers').attr("href");
        ciudad = ciudad.replace("http://", "");
        page -= 1;

        loadInfoMaps(ciudad, page);
      }
    });

    j('.main__map__info').on('swipeleft', function(){
      var nav = j('#js-pag-maps');
      var page = parseInt(nav.find('span.current').text());
      var last = j('#js-totalpage').text();

      if ( page < last )
      {
        var ciudad = nav.find('a.page-numbers').attr("href");
        ciudad = ciudad.replace("http://", "");
        page += 1;

        loadInfoMaps(ciudad, page);
      }
    });

    // Funcionalidad Selección de Distrito
    $body.on('change', '.sel-distrito', function(ev){
      ev.preventDefault();

      var $this = j(this);
      var ciudad = parseInt($this.data('ciudad'));
      var distrito = ($this.val().length > 0) ? $this.val() : 0;
      var page = 1;
      // var tag = 0;

      if ( ciudad > 0 )
      {
        loadInfoMaps(ciudad, page, distrito);
        // loadInfoMaps(ciudad, page, distrito, tag);
      }
    });

    // Filter by type credit
    /*
    j('.sel-tipo-credito').on('change', function(ev){
      ev.preventDefault();

      var $this = j(this);
      var tag = $this.val();
      var ciudad = 0;
      var distrito = 0;
      var page = 1;

      if ( tag !== '' || tag.length > 0 )
      {
        // Select city checked 0
        j('.sel-map').find('option').first().prop('selected', true);

        // Select distrito clear
        var $wrapperDistrito = j('.wrapper-sel-dist');
        var intro = '<select class="frm-ilc__select form-control sel-distrito frm-ilc__select--noborder" data-ciudad="">'
                    + '<option value="">-- Selecciona tu Distrito --</option>'
                    + '</select>';

        $wrapperDistrito.html('').html(intro);

        loadInfoMaps(ciudad, page, distrito, tag);
      }
    });*/

    /* -------------------------------------------------------------------------------------------------------------------- */

    // Validaciones formularios de Unete al Equipo
    j('#js-frm-postulante').formValidation({
      framework: 'bootstrap',
      excluded: ':disabled',
      // To use feedback icons, ensure that you use Bootstrap v3.1.0 or later
      feedbackIcons: {
        valid: 'glyphicon glyphicon-ok',
        invalid: 'glyphicon glyphicon-remove',
        validating: 'glyphicon glyphicon-refresh'
      },
      fields: {
        mb_name: {
          validators: {
            notEmpty: {
                message: 'Campo requerido'
            },
            regexp: {
                regexp: /^[a-zA-ZñÑ\s\W]/,
                message: 'Sólo puede contener caracteres alfabeticos'
            }
          }
        },
        mb_email: {
          validators: {
            notEmpty: {
                message: 'Campo equerido'
            },
            emailAddress: {
                message: 'Email no es válido'
            }
          }
        },
        mb_tel: {
          validators: {
            notEmpty: {
              message: 'Campo requerido'
            }
          }
        },
        'mb_jobs[]': {
          validators: {
            callback: {
              message: 'Selecciona el puesto a postular',
              callback: function(value, validator, $field) {
                var options = validator.getFieldElements('mb_jobs[]').val();

                return (options != null && options.length >= 1);
              }
            }
          }
        },
        mb_cv: {
          validators: {
            notEmpty: {
              message: 'Debe ingresar su CV'
            }
          }
        }
      },
    })
    .find('[name="mb_jobs[]"]')
      .multiselect({
        onchange: function(element, checked) {
          j('#js-frm-postulante').formValidation('revalidateField', 'mb_jobs[]');
        },
        buttonText: function(options, select) {
          if ( options.length === 0)
          {
            return 'Selecciona el puesto a postular';
          }
          else if (options.length > 2)
          {
            return 'Más de 2 opciones seleccionadas!';
          }
          else
          {
            var labels = [];
            options.each(function() {
              if ($(this).attr('label') !== undefined)
              {
                labels.push($(this).attr('label'));
              }
              else
              {
                labels.push($(this).html());
              }
            });

            return labels.join(', ') + '';
          }
        }
      })
      .end()
    .on('err.field.fv', function(e, data) {
        var field = e.target;
        j('small.help-block[data-bv-result="INVALID"]').addClass('hide');
    });

    var $container = j('.main__blog').imagesLoaded( function(){
      $container.isotope({
        itemSelector: '.main__blog__item',
        layoutMode: 'masonry',
        masonry: {
          columnWidth: '.grid-sizer',
          gutter: '.gutter-sizer'
        },
        percentPosition: true
      });
    });

    // Validaciones formularios de Unete al Equipo
    j('#js-frm-reclamo, #js-frm-reclamo-movil')
      .find('[name="rec_city"]')
        .change(function(e) {
          j('#js-frm-reclamo').formValidation('revalidateField', 'rec_city');
        })
        .end()
      .find('[name="rec_response"]')
        .change(function(e) {
          j('#js-frm-reclamo').formValidation('revalidateField', 'rec_response');
        })
        .end()
      .find('[name="rec_service"]')
        .change(function(e) {
          j('#js-frm-reclamo').formValidation('revalidateField', 'rec_service');
        })
        .end()
      .formValidation({
        framework: 'bootstrap',
        excluded: ':disabled',
        // To use feedback icons, ensure that you use Bootstrap v3.1.0 or later
        feedbackIcons: {
          valid: 'glyphicon glyphicon-ok',
          invalid: 'glyphicon glyphicon-remove',
          validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
          rec_name: {
            validators: {
              notEmpty: {
                  message: 'Campo requerido'
              },
              regexp: {
                  regexp: /^[a-zA-ZñÑ\s\W]/,
                  message: 'Sólo puede contener caracteres alfabeticos'
              }
            }
          },
          rec_email: {
            validators: {
              notEmpty: {
                  message: 'Campo equerido'
              },
              emailAddress: {
                  message: 'Email no es válido'
              }
            }
          },
          rec_address: {
            validators: {
              notEmpty: {
                message: 'Campo requerido'
              }
            }
          },
          rec_dni: {
            validators: {
              notEmpty: {
                message: 'Campo requerido'
              },
              integer: {
                message: 'Debe ingresar solo dígitos'
              },
              stringLength: {
                message: 'Debe contener mínimo 8 y máximo 12 caracteres',
                min: 8,
                max: 12
              }
            }
          },
          rec_phone: {
            validators: {
              notEmpty: {
                message: 'Campo requerido'
              }
            }
          },
          rec_city: {
            validators: {
              callback: {
                message: 'Indique ciudad o departamento',
                callback: function(value, validator, $field) {
                  if ( value.length === 0 )
                  {
                    return false;
                  }

                  return true;
                }
              }
            }
          },
          rec_response: {
            validators: {
              callback: {
                message: 'Indique método de respuesta',
                callback: function(value, validator, $field) {
                  if ( value.length === 0 )
                  {
                    return false;
                  }

                  return true;
                }
              }
            }
          },
          rec_service: {
            validators: {
              callback: {
                message: 'Indique producto o servicio contratado',
                callback: function(value, validator, $field) {
                  if ( value.length === 0 )
                  {
                    return false;
                  }

                  return true;
                }
              }
            }
          },
          rec_contrato: {
            validators: {
              notEmpty: {
                message: 'Campo requerido'
              }
            }
          },
          rec_monto: {
            validators: {
              notEmpty: {
                message: 'Campo requerido'
              }
            }
          },
          rec_detail: {
            validators: {
              notEmpty: {
                message: 'Campo requerido'
              },
              stringLength: {
                message: 'Debe contener máximo 2000 caracteres',
                max: 2000
              }
            }
          },
          rec_order: {
            validators: {
              notEmpty: {
                message: 'Campo requerido'
              },
              stringLength: {
                message: 'Debe contener máximo 200 caracteres',
                max: 200
              }
            }
          },
          rec_terminos: {
            validators: {
              choice: {
                message: 'Debe aceptar los términos y condiciones',
                min: 1,
                max: 1
              }
            }
          }
        },
      })
      .on('err.field.fv', function(e, data) {
          var field = e.target;
          j('small.help-block[data-bv-result="INVALID"]').addClass('hide');
      });
    //   .on('success.form.fv', function(e){
    //     alert('bien vamos bien');
    // });

    // Ver terminos y condiciones
    j('.rec_terminos').on('click', function(ev){
      if ( j(this).prop('checked') )
      {
        j('#js-terminos').modal('show');
      }
    });

    // Carousel Libro de reclamaciones movil
    j('#js-car-book').carousel({
      interval : false
    });

    j('#js-next-book').on('click', function(ev){
      ev.preventDefault();

      j('#js-car-book').carousel('next');
    });

    j('#js-prev-book').on('click', function(ev){
      ev.preventDefault();

      j('#js-car-book').carousel('prev');
    });

    // Open modal js-terminos scroll to top
    j('#js-terminos').on('shown.bs.modal', function(){
      // Hide nav
      j('.header__main-menu').css({
        'z-index': 1,
      });

      j('body, html').animate({
        scrollTop: 0
      }, 1);
    });

    // Hide modal js-terminos show nav
    j('#js-terminos').on('hidden.bs.modal', function(){
      j('.header__main-menu').css({
        'z-index': 9,
      });
    });

    function bottomFooter()
    {
      var heightFooter = $footer.outerHeight();
      $footer.css('bottom', -heightFooter + 'px');
    }
  });

  // function loadInfoMaps(ciudad, page, distrito, tag)
  function loadInfoMaps(ciudad, page, distrito)
  {
    var container = j('.main__map__info');
    var noinfo = j('.main__map__info--no-info');
    var nofound = '<p class="alert alert-info text-center">No se encontró agencias en esta ciudad.</p>';
    var loader = j('#js-loader-agencias');

    if ( noinfo.css( 'display' ) != 'none' )
    {
      noinfo.addClass('hidden');
      container.html('');
    }
    else
    {
      container.html('');
    }

    loader.removeClass('hidden');

    ciudad   = parseInt(ciudad);
    distrito = parseInt(distrito);
    // tag      = parseInt(tag);

    j.post(MyAjax.url, {
      nonce    : MyAjax.nonce,
      action   : 'get_agencias',
      ciudad   : ciudad,
      distrito : distrito,
      // tag      : tag,
      page     : page
    }, function(data) {
      // debugger
      loader.addClass('hidden');

      var html = '';

      if ( data.result )
      {
        html = data.content;
      }
      else
      {
        html = nofound;
      }

      container.html(html);
    }, 'json')
    .fail(function(){
      console.log('falle');
    });
  }

  function activeTabService()
  {
    var hash = window.location.hash;
    var tabContainer = j('#js-tab-service');

    if ( hash.length > 0 )
    {
      if ( tabContainer.length === 1 )
      {
        j('#js-tab-service a[href="' + hash + '"]').tab('show');
      }
    }
  }

  function generateSelDistritos(data, ciudad)
  {
    var $sel = j('.sel-distrito');
    var intro = '<option value="">-- Selecciona tu Distrito --</option>';

    $sel.data('ciudad', ciudad);
    $sel.html('').html(intro);

    j.each(data, function(index, el) {
      $sel.append('<option value="' + el.cat_ID + '">' + el.cat_name + '</option>')
    });
  }

  j('.js-load-video').on('click', function(){
    var $this = j(this);
    var video = $this.data('video');
    var site = $this.data('site');

    j('.js-load-video').removeClass('active');
    j('.Felicidad-histories-video').removeClass().addClass('Felicidad-histories-video Felicidad-histories-video--' + site);
    $this.addClass('active');
    loadVideo(video);
  });
}) (jQuery);

/*
function onYouTubeIframeAPIReady() {
  player = new YT.Player('player', {
    height: '318',
    width: '100%',
    videoId: 'XjjG_FMcTAc',
    /*events: {
      'onReady': onPlayerReady,
      //'onStateChange': onPlayerStateChange
    }*
  });
}*/

function onPlayerReady(event)
{
  event.target.playVideo();
}

function playVideo()
{
  player.playVideo();
}

function pauseVideo()
{
  player.pauseVideo();
}

function stopVideo()
{
  player.stopVideo();
}

function loadMap(lat, lon, id, content)
{
  var mapCoord = new google.maps.LatLng(lat, lon);
  var opciones = {
    zoom : 16,
    //mapTypeControl: false,
    center: mapCoord,
    //panControl: false,
    //rotateControl: false,
    //streetViewControl: false,
    mapTypeId: google.maps.MapTypeId.ROADMAP
  };

  var div = document.getElementById(id);
  map = new google.maps.Map(div, opciones);

  /***************************************** this *********************************************/
  var infobox_props = {
      content: content,
      disableAutoPan: false,
      maxWidth: 0,
      pixelOffset: new google.maps.Size(-10, 0),
      zIndex: null,
      boxClass: "myInfobox",
      closeBoxMargin: "2px",
      //closeBoxURL: "close_sm.png",
      infoBoxClearance: new google.maps.Size(1, 1),
      visible: true,
      pane: "floatPane",
      enableEventPropagation: false
  };

  var infoBox = new InfoBox(infobox_props);

  var marker = new google.maps.Marker({
      map: map,
      draggable: false,
      //icon: mappin,
      position: mapCoord,
      title: "Mamma Tomato",
      maxWidth: 200,
      maxHeight: 200,
      visible: true
  });

  google.maps.event.addListener(marker, "click", function (e) {
    infoBox.open(map, marker);
  });

  //infoBox.open(map, marker);
  /***************************************** this *********************************************/

  /*// Creamos un marcador y lo posicionamos en el mapa
  var marcador = new google.maps.Marker({
    position: mapCoord,
      map: map,
      title: 'Mamma Tomato'
  });

  var infowindow = new google.maps.InfoWindow({
      content: content
      content: 'Av. El Sol 1191 - Urb. La Campiña<br>'
              +'Teléfono: (511) 1234 - 5689<br>'
              +'Fax: (511) 1234 - 5688'
  });

  google.maps.event.addListener(marcador, 'click', function() {
      infowindow.open(map, marcador);
  });*/
}
