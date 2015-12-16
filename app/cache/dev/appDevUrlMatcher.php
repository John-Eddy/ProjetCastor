<?php

use Symfony\Component\Routing\Exception\MethodNotAllowedException;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;
use Symfony\Component\Routing\RequestContext;

/**
 * appDevUrlMatcher.
 *
 * This class has been auto-generated
 * by the Symfony Routing Component.
 */
class appDevUrlMatcher extends Symfony\Bundle\FrameworkBundle\Routing\RedirectableUrlMatcher
{
    /**
     * Constructor.
     */
    public function __construct(RequestContext $context)
    {
        $this->context = $context;
    }

    public function match($pathinfo)
    {
        $allow = array();
        $pathinfo = rawurldecode($pathinfo);
        $context = $this->context;
        $request = $this->request;

        if (0 === strpos($pathinfo, '/_')) {
            // _wdt
            if (0 === strpos($pathinfo, '/_wdt') && preg_match('#^/_wdt/(?P<token>[^/]++)$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => '_wdt')), array (  '_controller' => 'web_profiler.controller.profiler:toolbarAction',));
            }

            if (0 === strpos($pathinfo, '/_profiler')) {
                // _profiler_home
                if (rtrim($pathinfo, '/') === '/_profiler') {
                    if (substr($pathinfo, -1) !== '/') {
                        return $this->redirect($pathinfo.'/', '_profiler_home');
                    }

                    return array (  '_controller' => 'web_profiler.controller.profiler:homeAction',  '_route' => '_profiler_home',);
                }

                if (0 === strpos($pathinfo, '/_profiler/search')) {
                    // _profiler_search
                    if ($pathinfo === '/_profiler/search') {
                        return array (  '_controller' => 'web_profiler.controller.profiler:searchAction',  '_route' => '_profiler_search',);
                    }

                    // _profiler_search_bar
                    if ($pathinfo === '/_profiler/search_bar') {
                        return array (  '_controller' => 'web_profiler.controller.profiler:searchBarAction',  '_route' => '_profiler_search_bar',);
                    }

                }

                // _profiler_purge
                if ($pathinfo === '/_profiler/purge') {
                    return array (  '_controller' => 'web_profiler.controller.profiler:purgeAction',  '_route' => '_profiler_purge',);
                }

                // _profiler_info
                if (0 === strpos($pathinfo, '/_profiler/info') && preg_match('#^/_profiler/info/(?P<about>[^/]++)$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => '_profiler_info')), array (  '_controller' => 'web_profiler.controller.profiler:infoAction',));
                }

                // _profiler_phpinfo
                if ($pathinfo === '/_profiler/phpinfo') {
                    return array (  '_controller' => 'web_profiler.controller.profiler:phpinfoAction',  '_route' => '_profiler_phpinfo',);
                }

                // _profiler_search_results
                if (preg_match('#^/_profiler/(?P<token>[^/]++)/search/results$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => '_profiler_search_results')), array (  '_controller' => 'web_profiler.controller.profiler:searchResultsAction',));
                }

                // _profiler
                if (preg_match('#^/_profiler/(?P<token>[^/]++)$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => '_profiler')), array (  '_controller' => 'web_profiler.controller.profiler:panelAction',));
                }

                // _profiler_router
                if (preg_match('#^/_profiler/(?P<token>[^/]++)/router$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => '_profiler_router')), array (  '_controller' => 'web_profiler.controller.router:panelAction',));
                }

                // _profiler_exception
                if (preg_match('#^/_profiler/(?P<token>[^/]++)/exception$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => '_profiler_exception')), array (  '_controller' => 'web_profiler.controller.exception:showAction',));
                }

                // _profiler_exception_css
                if (preg_match('#^/_profiler/(?P<token>[^/]++)/exception\\.css$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => '_profiler_exception_css')), array (  '_controller' => 'web_profiler.controller.exception:cssAction',));
                }

            }

            if (0 === strpos($pathinfo, '/_configurator')) {
                // _configurator_home
                if (rtrim($pathinfo, '/') === '/_configurator') {
                    if (substr($pathinfo, -1) !== '/') {
                        return $this->redirect($pathinfo.'/', '_configurator_home');
                    }

                    return array (  '_controller' => 'Sensio\\Bundle\\DistributionBundle\\Controller\\ConfiguratorController::checkAction',  '_route' => '_configurator_home',);
                }

                // _configurator_step
                if (0 === strpos($pathinfo, '/_configurator/step') && preg_match('#^/_configurator/step/(?P<index>[^/]++)$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => '_configurator_step')), array (  '_controller' => 'Sensio\\Bundle\\DistributionBundle\\Controller\\ConfiguratorController::stepAction',));
                }

                // _configurator_final
                if ($pathinfo === '/_configurator/final') {
                    return array (  '_controller' => 'Sensio\\Bundle\\DistributionBundle\\Controller\\ConfiguratorController::finalAction',  '_route' => '_configurator_final',);
                }

            }

            // _twig_error_test
            if (0 === strpos($pathinfo, '/_error') && preg_match('#^/_error/(?P<code>\\d+)(?:\\.(?P<_format>[^/]++))?$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => '_twig_error_test')), array (  '_controller' => 'twig.controller.preview_error:previewErrorPageAction',  '_format' => 'html',));
            }

        }

        // gestion_frais_homepage
        if (rtrim($pathinfo, '/') === '') {
            if (substr($pathinfo, -1) !== '/') {
                return $this->redirect($pathinfo.'/', 'gestion_frais_homepage');
            }

            return array (  '_controller' => 'GestionFraisBundle\\Controller\\DefaultController::indexAction',  '_route' => 'gestion_frais_homepage',);
        }

        if (0 === strpos($pathinfo, '/f')) {
            // fichefrais_consulter
            if (0 === strpos($pathinfo, '/fichefrais') && preg_match('#^/fichefrais/(?P<mois>[^/]++)/consulterFiche$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'fichefrais_consulter')), array (  '_controller' => 'GestionFraisBundle\\Controller\\FicheFraisOldController::consulterFicheAction',));
            }

            if (0 === strpos($pathinfo, '/fraisforfait')) {
                // fraisforfait
                if (rtrim($pathinfo, '/') === '/fraisforfait') {
                    if (substr($pathinfo, -1) !== '/') {
                        return $this->redirect($pathinfo.'/', 'fraisforfait');
                    }

                    return array (  '_controller' => 'GestionFraisBundle\\Controller\\FraisForfaitController::indexAction',  '_route' => 'fraisforfait',);
                }

                // fraisforfait_show
                if (preg_match('#^/fraisforfait/(?P<id>[^/]++)/show$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'fraisforfait_show')), array (  '_controller' => 'GestionFraisBundle\\Controller\\FraisForfaitController::showAction',));
                }

                // fraisforfait_new
                if ($pathinfo === '/fraisforfait/new') {
                    return array (  '_controller' => 'GestionFraisBundle\\Controller\\FraisForfaitController::newAction',  '_route' => 'fraisforfait_new',);
                }

                // fraisforfait_create
                if ($pathinfo === '/fraisforfait/create') {
                    if ($this->context->getMethod() != 'POST') {
                        $allow[] = 'POST';
                        goto not_fraisforfait_create;
                    }

                    return array (  '_controller' => 'GestionFraisBundle\\Controller\\FraisForfaitController::createAction',  '_route' => 'fraisforfait_create',);
                }
                not_fraisforfait_create:

                // fraisforfait_edit
                if (preg_match('#^/fraisforfait/(?P<id>[^/]++)/edit$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'fraisforfait_edit')), array (  '_controller' => 'GestionFraisBundle\\Controller\\FraisForfaitController::editAction',));
                }

                // fraisforfait_update
                if (preg_match('#^/fraisforfait/(?P<id>[^/]++)/update$#s', $pathinfo, $matches)) {
                    if (!in_array($this->context->getMethod(), array('POST', 'PUT'))) {
                        $allow = array_merge($allow, array('POST', 'PUT'));
                        goto not_fraisforfait_update;
                    }

                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'fraisforfait_update')), array (  '_controller' => 'GestionFraisBundle\\Controller\\FraisForfaitController::updateAction',));
                }
                not_fraisforfait_update:

                // fraisforfait_delete
                if (preg_match('#^/fraisforfait/(?P<id>[^/]++)/delete$#s', $pathinfo, $matches)) {
                    if (!in_array($this->context->getMethod(), array('POST', 'DELETE'))) {
                        $allow = array_merge($allow, array('POST', 'DELETE'));
                        goto not_fraisforfait_delete;
                    }

                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'fraisforfait_delete')), array (  '_controller' => 'GestionFraisBundle\\Controller\\FraisForfaitController::deleteAction',));
                }
                not_fraisforfait_delete:

            }

        }

        if (0 === strpos($pathinfo, '/etat')) {
            if (0 === strpos($pathinfo, '/etatlignefrais')) {
                // etatlignefrais
                if (rtrim($pathinfo, '/') === '/etatlignefrais') {
                    if (substr($pathinfo, -1) !== '/') {
                        return $this->redirect($pathinfo.'/', 'etatlignefrais');
                    }

                    return array (  '_controller' => 'GestionFraisBundle\\Controller\\EtatLigneFraisController::indexAction',  '_route' => 'etatlignefrais',);
                }

                // etatlignefrais_show
                if (preg_match('#^/etatlignefrais/(?P<id>[^/]++)/show$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'etatlignefrais_show')), array (  '_controller' => 'GestionFraisBundle\\Controller\\EtatLigneFraisController::showAction',));
                }

                // etatlignefrais_new
                if ($pathinfo === '/etatlignefrais/new') {
                    return array (  '_controller' => 'GestionFraisBundle\\Controller\\EtatLigneFraisController::newAction',  '_route' => 'etatlignefrais_new',);
                }

                // etatlignefrais_create
                if ($pathinfo === '/etatlignefrais/create') {
                    if ($this->context->getMethod() != 'POST') {
                        $allow[] = 'POST';
                        goto not_etatlignefrais_create;
                    }

                    return array (  '_controller' => 'GestionFraisBundle\\Controller\\EtatLigneFraisController::createAction',  '_route' => 'etatlignefrais_create',);
                }
                not_etatlignefrais_create:

                // etatlignefrais_edit
                if (preg_match('#^/etatlignefrais/(?P<id>[^/]++)/edit$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'etatlignefrais_edit')), array (  '_controller' => 'GestionFraisBundle\\Controller\\EtatLigneFraisController::editAction',));
                }

                // etatlignefrais_update
                if (preg_match('#^/etatlignefrais/(?P<id>[^/]++)/update$#s', $pathinfo, $matches)) {
                    if (!in_array($this->context->getMethod(), array('POST', 'PUT'))) {
                        $allow = array_merge($allow, array('POST', 'PUT'));
                        goto not_etatlignefrais_update;
                    }

                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'etatlignefrais_update')), array (  '_controller' => 'GestionFraisBundle\\Controller\\EtatLigneFraisController::updateAction',));
                }
                not_etatlignefrais_update:

                // etatlignefrais_delete
                if (preg_match('#^/etatlignefrais/(?P<id>[^/]++)/delete$#s', $pathinfo, $matches)) {
                    if (!in_array($this->context->getMethod(), array('POST', 'DELETE'))) {
                        $allow = array_merge($allow, array('POST', 'DELETE'));
                        goto not_etatlignefrais_delete;
                    }

                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'etatlignefrais_delete')), array (  '_controller' => 'GestionFraisBundle\\Controller\\EtatLigneFraisController::deleteAction',));
                }
                not_etatlignefrais_delete:

            }

            if (0 === strpos($pathinfo, '/etatfichefrais')) {
                // etatfichefrais
                if (rtrim($pathinfo, '/') === '/etatfichefrais') {
                    if (substr($pathinfo, -1) !== '/') {
                        return $this->redirect($pathinfo.'/', 'etatfichefrais');
                    }

                    return array (  '_controller' => 'GestionFraisBundle\\Controller\\EtatFicheFraisController::indexAction',  '_route' => 'etatfichefrais',);
                }

                // etatfichefrais_show
                if (preg_match('#^/etatfichefrais/(?P<id>[^/]++)/show$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'etatfichefrais_show')), array (  '_controller' => 'GestionFraisBundle\\Controller\\EtatFicheFraisController::showAction',));
                }

                // etatfichefrais_new
                if ($pathinfo === '/etatfichefrais/new') {
                    return array (  '_controller' => 'GestionFraisBundle\\Controller\\EtatFicheFraisController::newAction',  '_route' => 'etatfichefrais_new',);
                }

                // etatfichefrais_create
                if ($pathinfo === '/etatfichefrais/create') {
                    if ($this->context->getMethod() != 'POST') {
                        $allow[] = 'POST';
                        goto not_etatfichefrais_create;
                    }

                    return array (  '_controller' => 'GestionFraisBundle\\Controller\\EtatFicheFraisController::createAction',  '_route' => 'etatfichefrais_create',);
                }
                not_etatfichefrais_create:

                // etatfichefrais_edit
                if (preg_match('#^/etatfichefrais/(?P<id>[^/]++)/edit$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'etatfichefrais_edit')), array (  '_controller' => 'GestionFraisBundle\\Controller\\EtatFicheFraisController::editAction',));
                }

                // etatfichefrais_update
                if (preg_match('#^/etatfichefrais/(?P<id>[^/]++)/update$#s', $pathinfo, $matches)) {
                    if (!in_array($this->context->getMethod(), array('POST', 'PUT'))) {
                        $allow = array_merge($allow, array('POST', 'PUT'));
                        goto not_etatfichefrais_update;
                    }

                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'etatfichefrais_update')), array (  '_controller' => 'GestionFraisBundle\\Controller\\EtatFicheFraisController::updateAction',));
                }
                not_etatfichefrais_update:

                // etatfichefrais_delete
                if (preg_match('#^/etatfichefrais/(?P<id>[^/]++)/delete$#s', $pathinfo, $matches)) {
                    if (!in_array($this->context->getMethod(), array('POST', 'DELETE'))) {
                        $allow = array_merge($allow, array('POST', 'DELETE'));
                        goto not_etatfichefrais_delete;
                    }

                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'etatfichefrais_delete')), array (  '_controller' => 'GestionFraisBundle\\Controller\\EtatFicheFraisController::deleteAction',));
                }
                not_etatfichefrais_delete:

            }

        }

        if (0 === strpos($pathinfo, '/visiteur')) {
            // visiteur
            if (rtrim($pathinfo, '/') === '/visiteur') {
                if (substr($pathinfo, -1) !== '/') {
                    return $this->redirect($pathinfo.'/', 'visiteur');
                }

                return array (  '_controller' => 'GestionFraisBundle\\Controller\\VisiteurController::indexAction',  '_route' => 'visiteur',);
            }

            // visiteur_show
            if (preg_match('#^/visiteur/(?P<id>[^/]++)/show$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'visiteur_show')), array (  '_controller' => 'GestionFraisBundle\\Controller\\VisiteurController::showAction',));
            }

            // visiteur_new
            if ($pathinfo === '/visiteur/new') {
                return array (  '_controller' => 'GestionFraisBundle\\Controller\\VisiteurController::newAction',  '_route' => 'visiteur_new',);
            }

            // visiteur_create
            if ($pathinfo === '/visiteur/create') {
                if ($this->context->getMethod() != 'POST') {
                    $allow[] = 'POST';
                    goto not_visiteur_create;
                }

                return array (  '_controller' => 'GestionFraisBundle\\Controller\\VisiteurController::createAction',  '_route' => 'visiteur_create',);
            }
            not_visiteur_create:

            // visiteur_edit
            if (preg_match('#^/visiteur/(?P<id>[^/]++)/edit$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'visiteur_edit')), array (  '_controller' => 'GestionFraisBundle\\Controller\\VisiteurController::editAction',));
            }

            // visiteur_update
            if (preg_match('#^/visiteur/(?P<id>[^/]++)/update$#s', $pathinfo, $matches)) {
                if (!in_array($this->context->getMethod(), array('POST', 'PUT'))) {
                    $allow = array_merge($allow, array('POST', 'PUT'));
                    goto not_visiteur_update;
                }

                return $this->mergeDefaults(array_replace($matches, array('_route' => 'visiteur_update')), array (  '_controller' => 'GestionFraisBundle\\Controller\\VisiteurController::updateAction',));
            }
            not_visiteur_update:

            // visiteur_delete
            if (preg_match('#^/visiteur/(?P<id>[^/]++)/delete$#s', $pathinfo, $matches)) {
                if (!in_array($this->context->getMethod(), array('POST', 'DELETE'))) {
                    $allow = array_merge($allow, array('POST', 'DELETE'));
                    goto not_visiteur_delete;
                }

                return $this->mergeDefaults(array_replace($matches, array('_route' => 'visiteur_delete')), array (  '_controller' => 'GestionFraisBundle\\Controller\\VisiteurController::deleteAction',));
            }
            not_visiteur_delete:

        }

        // homepage
        if (rtrim($pathinfo, '/') === '') {
            if (substr($pathinfo, -1) !== '/') {
                return $this->redirect($pathinfo.'/', 'homepage');
            }

            return array (  '_controller' => 'AppBundle\\Controller\\DefaultController::indexAction',  '_route' => 'homepage',);
        }

        if (0 === strpos($pathinfo, '/log')) {
            if (0 === strpos($pathinfo, '/login')) {
                // fos_user_security_login
                if ($pathinfo === '/login') {
                    if (!in_array($this->context->getMethod(), array('GET', 'POST', 'HEAD'))) {
                        $allow = array_merge($allow, array('GET', 'POST', 'HEAD'));
                        goto not_fos_user_security_login;
                    }

                    return array (  '_controller' => 'FOS\\UserBundle\\Controller\\SecurityController::loginAction',  '_route' => 'fos_user_security_login',);
                }
                not_fos_user_security_login:

                // fos_user_security_check
                if ($pathinfo === '/login_check') {
                    if ($this->context->getMethod() != 'POST') {
                        $allow[] = 'POST';
                        goto not_fos_user_security_check;
                    }

                    return array (  '_controller' => 'FOS\\UserBundle\\Controller\\SecurityController::checkAction',  '_route' => 'fos_user_security_check',);
                }
                not_fos_user_security_check:

            }

            // fos_user_security_logout
            if ($pathinfo === '/logout') {
                if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'HEAD'));
                    goto not_fos_user_security_logout;
                }

                return array (  '_controller' => 'FOS\\UserBundle\\Controller\\SecurityController::logoutAction',  '_route' => 'fos_user_security_logout',);
            }
            not_fos_user_security_logout:

        }

        if (0 === strpos($pathinfo, '/profile')) {
            // fos_user_profile_show
            if (rtrim($pathinfo, '/') === '/profile') {
                if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'HEAD'));
                    goto not_fos_user_profile_show;
                }

                if (substr($pathinfo, -1) !== '/') {
                    return $this->redirect($pathinfo.'/', 'fos_user_profile_show');
                }

                return array (  '_controller' => 'FOS\\UserBundle\\Controller\\ProfileController::showAction',  '_route' => 'fos_user_profile_show',);
            }
            not_fos_user_profile_show:

            // fos_user_profile_edit
            if ($pathinfo === '/profile/edit') {
                if (!in_array($this->context->getMethod(), array('GET', 'POST', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'POST', 'HEAD'));
                    goto not_fos_user_profile_edit;
                }

                return array (  '_controller' => 'FOS\\UserBundle\\Controller\\ProfileController::editAction',  '_route' => 'fos_user_profile_edit',);
            }
            not_fos_user_profile_edit:

        }

        if (0 === strpos($pathinfo, '/re')) {
            if (0 === strpos($pathinfo, '/register')) {
                // fos_user_registration_register
                if (rtrim($pathinfo, '/') === '/register') {
                    if (!in_array($this->context->getMethod(), array('GET', 'POST', 'HEAD'))) {
                        $allow = array_merge($allow, array('GET', 'POST', 'HEAD'));
                        goto not_fos_user_registration_register;
                    }

                    if (substr($pathinfo, -1) !== '/') {
                        return $this->redirect($pathinfo.'/', 'fos_user_registration_register');
                    }

                    return array (  '_controller' => 'FOS\\UserBundle\\Controller\\RegistrationController::registerAction',  '_route' => 'fos_user_registration_register',);
                }
                not_fos_user_registration_register:

                if (0 === strpos($pathinfo, '/register/c')) {
                    // fos_user_registration_check_email
                    if ($pathinfo === '/register/check-email') {
                        if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                            $allow = array_merge($allow, array('GET', 'HEAD'));
                            goto not_fos_user_registration_check_email;
                        }

                        return array (  '_controller' => 'FOS\\UserBundle\\Controller\\RegistrationController::checkEmailAction',  '_route' => 'fos_user_registration_check_email',);
                    }
                    not_fos_user_registration_check_email:

                    if (0 === strpos($pathinfo, '/register/confirm')) {
                        // fos_user_registration_confirm
                        if (preg_match('#^/register/confirm/(?P<token>[^/]++)$#s', $pathinfo, $matches)) {
                            if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                                $allow = array_merge($allow, array('GET', 'HEAD'));
                                goto not_fos_user_registration_confirm;
                            }

                            return $this->mergeDefaults(array_replace($matches, array('_route' => 'fos_user_registration_confirm')), array (  '_controller' => 'FOS\\UserBundle\\Controller\\RegistrationController::confirmAction',));
                        }
                        not_fos_user_registration_confirm:

                        // fos_user_registration_confirmed
                        if ($pathinfo === '/register/confirmed') {
                            if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                                $allow = array_merge($allow, array('GET', 'HEAD'));
                                goto not_fos_user_registration_confirmed;
                            }

                            return array (  '_controller' => 'FOS\\UserBundle\\Controller\\RegistrationController::confirmedAction',  '_route' => 'fos_user_registration_confirmed',);
                        }
                        not_fos_user_registration_confirmed:

                    }

                }

            }

            if (0 === strpos($pathinfo, '/resetting')) {
                // fos_user_resetting_request
                if ($pathinfo === '/resetting/request') {
                    if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                        $allow = array_merge($allow, array('GET', 'HEAD'));
                        goto not_fos_user_resetting_request;
                    }

                    return array (  '_controller' => 'FOS\\UserBundle\\Controller\\ResettingController::requestAction',  '_route' => 'fos_user_resetting_request',);
                }
                not_fos_user_resetting_request:

                // fos_user_resetting_send_email
                if ($pathinfo === '/resetting/send-email') {
                    if ($this->context->getMethod() != 'POST') {
                        $allow[] = 'POST';
                        goto not_fos_user_resetting_send_email;
                    }

                    return array (  '_controller' => 'FOS\\UserBundle\\Controller\\ResettingController::sendEmailAction',  '_route' => 'fos_user_resetting_send_email',);
                }
                not_fos_user_resetting_send_email:

                // fos_user_resetting_check_email
                if ($pathinfo === '/resetting/check-email') {
                    if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                        $allow = array_merge($allow, array('GET', 'HEAD'));
                        goto not_fos_user_resetting_check_email;
                    }

                    return array (  '_controller' => 'FOS\\UserBundle\\Controller\\ResettingController::checkEmailAction',  '_route' => 'fos_user_resetting_check_email',);
                }
                not_fos_user_resetting_check_email:

                // fos_user_resetting_reset
                if (0 === strpos($pathinfo, '/resetting/reset') && preg_match('#^/resetting/reset/(?P<token>[^/]++)$#s', $pathinfo, $matches)) {
                    if (!in_array($this->context->getMethod(), array('GET', 'POST', 'HEAD'))) {
                        $allow = array_merge($allow, array('GET', 'POST', 'HEAD'));
                        goto not_fos_user_resetting_reset;
                    }

                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'fos_user_resetting_reset')), array (  '_controller' => 'FOS\\UserBundle\\Controller\\ResettingController::resetAction',));
                }
                not_fos_user_resetting_reset:

            }

        }

        // fos_user_change_password
        if ($pathinfo === '/profile/change-password') {
            if (!in_array($this->context->getMethod(), array('GET', 'POST', 'HEAD'))) {
                $allow = array_merge($allow, array('GET', 'POST', 'HEAD'));
                goto not_fos_user_change_password;
            }

            return array (  '_controller' => 'FOS\\UserBundle\\Controller\\ChangePasswordController::changePasswordAction',  '_route' => 'fos_user_change_password',);
        }
        not_fos_user_change_password:

        if (0 === strpos($pathinfo, '/utilisateur')) {
            // utilisateur_index
            if (rtrim($pathinfo, '/') === '/utilisateur') {
                if (substr($pathinfo, -1) !== '/') {
                    return $this->redirect($pathinfo.'/', 'utilisateur_index');
                }

                return array (  '_controller' => 'GestionFraisBundle\\Controller\\UtilisateurController::IndexAction',  '_route' => 'utilisateur_index',);
            }

            // utilisateur_consulter
            if (0 === strpos($pathinfo, '/utilisateur/consulter') && preg_match('#^/utilisateur/consulter/(?P<mois>[^/]++)$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'utilisateur_consulter')), array (  '_controller' => 'GestionFraisBundle\\Controller\\UtilisateurController::ConsulterFicheAction',));
            }

            // utilisateur_renseigner
            if (0 === strpos($pathinfo, '/utilisateur/renseigner') && preg_match('#^/utilisateur/renseigner/(?P<mois>[^/]++)$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'utilisateur_renseigner')), array (  '_controller' => 'GestionFraisBundle\\Controller\\UtilisateurController::RenseignerFicheAction',));
            }

        }

        // comptable_index
        if (rtrim($pathinfo, '/') === '/comptable') {
            if (substr($pathinfo, -1) !== '/') {
                return $this->redirect($pathinfo.'/', 'comptable_index');
            }

            return array (  '_controller' => 'GestionFraisBundle\\Controller\\ComptableController::IndexAction',  '_route' => 'comptable_index',);
        }

        throw 0 < count($allow) ? new MethodNotAllowedException(array_unique($allow)) : new ResourceNotFoundException();
    }
}
