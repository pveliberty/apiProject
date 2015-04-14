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

        // _welcome
        if (rtrim($pathinfo, '/') === '') {
            if (substr($pathinfo, -1) !== '/') {
                return $this->redirect($pathinfo.'/', '_welcome');
            }

            return array (  '_controller' => 'Symfony\\Bundle\\FrameworkBundle\\Controller\\RedirectController::redirectAction',  'route' => 'get_notes',  'permanent' => true,  '_route' => '_welcome',);
        }

        if (0 === strpos($pathinfo, '/notes')) {
            // new_note
            if (0 === strpos($pathinfo, '/notes/new') && preg_match('#^/notes/new(?:\\.(?P<_format>xml|json|html))?$#s', $pathinfo, $matches)) {
                if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'HEAD'));
                    goto not_new_note;
                }

                return $this->mergeDefaults(array_replace($matches, array('_route' => 'new_note')), array (  '_controller' => 'Acme\\DemoBundle\\Controller\\NoteController::newNoteAction',  '_format' => 'json',));
            }
            not_new_note:

            // edit_notes
            if (preg_match('#^/notes/(?P<id>[^/]++)/edit(?:\\.(?P<_format>xml|json|html))?$#s', $pathinfo, $matches)) {
                if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'HEAD'));
                    goto not_edit_notes;
                }

                return $this->mergeDefaults(array_replace($matches, array('_route' => 'edit_notes')), array (  '_controller' => 'Acme\\DemoBundle\\Controller\\NoteController::editNotesAction',  '_format' => 'json',));
            }
            not_edit_notes:

            // remove_notes
            if (preg_match('#^/notes/(?P<id>[^/]++)/remove(?:\\.(?P<_format>xml|json|html))?$#s', $pathinfo, $matches)) {
                if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'HEAD'));
                    goto not_remove_notes;
                }

                return $this->mergeDefaults(array_replace($matches, array('_route' => 'remove_notes')), array (  '_controller' => 'Acme\\DemoBundle\\Controller\\NoteController::removeNotesAction',  '_format' => 'json',));
            }
            not_remove_notes:

            // get_notes
            if (preg_match('#^/notes(?:\\.(?P<_format>xml|json|html))?$#s', $pathinfo, $matches)) {
                if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'HEAD'));
                    goto not_get_notes;
                }

                return $this->mergeDefaults(array_replace($matches, array('_route' => 'get_notes')), array (  '_controller' => 'Acme\\DemoBundle\\Controller\\NoteController::getNotesAction',  '_format' => 'json',));
            }
            not_get_notes:

            // get_note
            if (preg_match('#^/notes/(?P<id>[^/\\.]++)(?:\\.(?P<_format>xml|json|html))?$#s', $pathinfo, $matches)) {
                if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'HEAD'));
                    goto not_get_note;
                }

                return $this->mergeDefaults(array_replace($matches, array('_route' => 'get_note')), array (  '_controller' => 'Acme\\DemoBundle\\Controller\\NoteController::getNoteAction',  '_format' => 'json',));
            }
            not_get_note:

            // post_notes
            if (preg_match('#^/notes(?:\\.(?P<_format>xml|json|html))?$#s', $pathinfo, $matches)) {
                if ($this->context->getMethod() != 'POST') {
                    $allow[] = 'POST';
                    goto not_post_notes;
                }

                return $this->mergeDefaults(array_replace($matches, array('_route' => 'post_notes')), array (  '_controller' => 'Acme\\DemoBundle\\Controller\\NoteController::postNotesAction',  '_format' => 'json',));
            }
            not_post_notes:

            // put_notes
            if (preg_match('#^/notes/(?P<id>[^/\\.]++)(?:\\.(?P<_format>xml|json|html))?$#s', $pathinfo, $matches)) {
                if ($this->context->getMethod() != 'PUT') {
                    $allow[] = 'PUT';
                    goto not_put_notes;
                }

                return $this->mergeDefaults(array_replace($matches, array('_route' => 'put_notes')), array (  '_controller' => 'Acme\\DemoBundle\\Controller\\NoteController::putNotesAction',  '_format' => 'json',));
            }
            not_put_notes:

            // delete_notes
            if (preg_match('#^/notes/(?P<id>[^/\\.]++)(?:\\.(?P<_format>xml|json|html))?$#s', $pathinfo, $matches)) {
                if ($this->context->getMethod() != 'DELETE') {
                    $allow[] = 'DELETE';
                    goto not_delete_notes;
                }

                return $this->mergeDefaults(array_replace($matches, array('_route' => 'delete_notes')), array (  '_controller' => 'Acme\\DemoBundle\\Controller\\NoteController::deleteNotesAction',  '_format' => 'json',));
            }
            not_delete_notes:

        }

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

        }

        // nelmio_api_doc_index
        if (rtrim($pathinfo, '/') === '/api/doc') {
            if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                $allow = array_merge($allow, array('GET', 'HEAD'));
                goto not_nelmio_api_doc_index;
            }

            if (substr($pathinfo, -1) !== '/') {
                return $this->redirect($pathinfo.'/', 'nelmio_api_doc_index');
            }

            return array (  '_controller' => 'Nelmio\\ApiDocBundle\\Controller\\ApiDocController::indexAction',  '_route' => 'nelmio_api_doc_index',);
        }
        not_nelmio_api_doc_index:

        if (0 === strpos($pathinfo, '/contacts')) {
            // api_v1_get_contacts
            if (preg_match('#^/contacts(?:\\.(?P<_format>xml|json|html))?$#s', $pathinfo, $matches) && ($context->getApiVersion() === "v1")) {
                if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'HEAD'));
                    goto not_api_v1_get_contacts;
                }

                return $this->mergeDefaults(array_replace($matches, array('_route' => 'api_v1_get_contacts')), array (  '_controller' => 'Acme\\DemoBundle\\Controller\\Api\\V1\\ContactController::getContactsAction',  '_format' => 'json',));
            }
            not_api_v1_get_contacts:

            // api_v1_get_contact
            if (preg_match('#^/contacts/(?P<id>[^/\\.]++)(?:\\.(?P<_format>xml|json|html))?$#s', $pathinfo, $matches) && ($context->getApiVersion() === "v1")) {
                if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'HEAD'));
                    goto not_api_v1_get_contact;
                }

                return $this->mergeDefaults(array_replace($matches, array('_route' => 'api_v1_get_contact')), array (  '_controller' => 'Acme\\DemoBundle\\Controller\\Api\\V1\\ContactController::getContactAction',  '_format' => 'json',));
            }
            not_api_v1_get_contact:

        }

        // api_v1_get_address_contact
        if (0 === strpos($pathinfo, '/addresses') && preg_match('#^/addresses/(?P<id>[^/]++)/contact(?:\\.(?P<_format>xml|json|html))?$#s', $pathinfo, $matches) && ($context->getApiVersion() === "v1")) {
            if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                $allow = array_merge($allow, array('GET', 'HEAD'));
                goto not_api_v1_get_address_contact;
            }

            return $this->mergeDefaults(array_replace($matches, array('_route' => 'api_v1_get_address_contact')), array (  '_controller' => 'Acme\\DemoBundle\\Controller\\Api\\V1\\ContactController::getAddressContactAction',  '_format' => 'json',));
        }
        not_api_v1_get_address_contact:

        // api_v1_get_right_contacts
        if (0 === strpos($pathinfo, '/rights') && preg_match('#^/rights/(?P<id>[^/]++)/contacts(?:\\.(?P<_format>xml|json|html))?$#s', $pathinfo, $matches) && ($context->getApiVersion() === "v1")) {
            if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                $allow = array_merge($allow, array('GET', 'HEAD'));
                goto not_api_v1_get_right_contacts;
            }

            return $this->mergeDefaults(array_replace($matches, array('_route' => 'api_v1_get_right_contacts')), array (  '_controller' => 'Acme\\DemoBundle\\Controller\\Api\\V1\\ContactController::getRightContactsAction',  '_format' => 'json',));
        }
        not_api_v1_get_right_contacts:

        if (0 === strpos($pathinfo, '/contacts')) {
            // api_v1_post_contact
            if (preg_match('#^/contacts(?:\\.(?P<_format>xml|json|html))?$#s', $pathinfo, $matches) && ($context->getApiVersion() === "v1")) {
                if ($this->context->getMethod() != 'POST') {
                    $allow[] = 'POST';
                    goto not_api_v1_post_contact;
                }

                return $this->mergeDefaults(array_replace($matches, array('_route' => 'api_v1_post_contact')), array (  '_controller' => 'Acme\\DemoBundle\\Controller\\Api\\V1\\ContactController::postContactAction',  '_format' => 'json',));
            }
            not_api_v1_post_contact:

            // api_v1_patch_contact
            if (preg_match('#^/contacts/(?P<id>[^/\\.]++)(?:\\.(?P<_format>xml|json|html))?$#s', $pathinfo, $matches) && ($context->getApiVersion() === "v1")) {
                if ($this->context->getMethod() != 'PATCH') {
                    $allow[] = 'PATCH';
                    goto not_api_v1_patch_contact;
                }

                return $this->mergeDefaults(array_replace($matches, array('_route' => 'api_v1_patch_contact')), array (  '_controller' => 'Acme\\DemoBundle\\Controller\\Api\\V1\\ContactController::patchContactAction',  '_format' => 'json',));
            }
            not_api_v1_patch_contact:

            // api_v1_put_contact
            if (preg_match('#^/contacts/(?P<id>[^/\\.]++)(?:\\.(?P<_format>xml|json|html))?$#s', $pathinfo, $matches) && ($context->getApiVersion() === "v1")) {
                if ($this->context->getMethod() != 'PUT') {
                    $allow[] = 'PUT';
                    goto not_api_v1_put_contact;
                }

                return $this->mergeDefaults(array_replace($matches, array('_route' => 'api_v1_put_contact')), array (  '_controller' => 'Acme\\DemoBundle\\Controller\\Api\\V1\\ContactController::putContactAction',  '_format' => 'json',));
            }
            not_api_v1_put_contact:

            // api_v1_delete_contact
            if (preg_match('#^/contacts/(?P<id>[^/\\.]++)(?:\\.(?P<_format>xml|json|html))?$#s', $pathinfo, $matches) && ($context->getApiVersion() === "v1")) {
                if ($this->context->getMethod() != 'DELETE') {
                    $allow[] = 'DELETE';
                    goto not_api_v1_delete_contact;
                }

                return $this->mergeDefaults(array_replace($matches, array('_route' => 'api_v1_delete_contact')), array (  '_controller' => 'Acme\\DemoBundle\\Controller\\Api\\V1\\ContactController::deleteContactAction',  '_format' => 'json',));
            }
            not_api_v1_delete_contact:

        }

        if (0 === strpos($pathinfo, '/addresses')) {
            // api_v1_get_addresses
            if (preg_match('#^/addresses(?:\\.(?P<_format>xml|json|html))?$#s', $pathinfo, $matches) && ($context->getApiVersion() === "v1")) {
                if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'HEAD'));
                    goto not_api_v1_get_addresses;
                }

                return $this->mergeDefaults(array_replace($matches, array('_route' => 'api_v1_get_addresses')), array (  '_controller' => 'Acme\\DemoBundle\\Controller\\Api\\V1\\AddressController::getAddressesAction',  '_format' => 'json',));
            }
            not_api_v1_get_addresses:

            // api_v1_get_address
            if (preg_match('#^/addresses/(?P<id>[^/\\.]++)(?:\\.(?P<_format>xml|json|html))?$#s', $pathinfo, $matches) && ($context->getApiVersion() === "v1")) {
                if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'HEAD'));
                    goto not_api_v1_get_address;
                }

                return $this->mergeDefaults(array_replace($matches, array('_route' => 'api_v1_get_address')), array (  '_controller' => 'Acme\\DemoBundle\\Controller\\Api\\V1\\AddressController::getAddressAction',  '_format' => 'json',));
            }
            not_api_v1_get_address:

        }

        // api_v1_get_contact_addresses
        if (0 === strpos($pathinfo, '/contacts') && preg_match('#^/contacts/(?P<id>[^/]++)/addresses(?:\\.(?P<_format>xml|json|html))?$#s', $pathinfo, $matches) && ($context->getApiVersion() === "v1")) {
            if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                $allow = array_merge($allow, array('GET', 'HEAD'));
                goto not_api_v1_get_contact_addresses;
            }

            return $this->mergeDefaults(array_replace($matches, array('_route' => 'api_v1_get_contact_addresses')), array (  '_controller' => 'Acme\\DemoBundle\\Controller\\Api\\V1\\AddressController::getContactAddressesAction',  '_format' => 'json',));
        }
        not_api_v1_get_contact_addresses:

        if (0 === strpos($pathinfo, '/addresses')) {
            // api_v1_post_address
            if (preg_match('#^/addresses(?:\\.(?P<_format>xml|json|html))?$#s', $pathinfo, $matches) && ($context->getApiVersion() === "v1")) {
                if ($this->context->getMethod() != 'POST') {
                    $allow[] = 'POST';
                    goto not_api_v1_post_address;
                }

                return $this->mergeDefaults(array_replace($matches, array('_route' => 'api_v1_post_address')), array (  '_controller' => 'Acme\\DemoBundle\\Controller\\Api\\V1\\AddressController::postAddressAction',  '_format' => 'json',));
            }
            not_api_v1_post_address:

            // api_v1_patch_address
            if (preg_match('#^/addresses/(?P<id>[^/\\.]++)(?:\\.(?P<_format>xml|json|html))?$#s', $pathinfo, $matches) && ($context->getApiVersion() === "v1")) {
                if ($this->context->getMethod() != 'PATCH') {
                    $allow[] = 'PATCH';
                    goto not_api_v1_patch_address;
                }

                return $this->mergeDefaults(array_replace($matches, array('_route' => 'api_v1_patch_address')), array (  '_controller' => 'Acme\\DemoBundle\\Controller\\Api\\V1\\AddressController::patchAddressAction',  '_format' => 'json',));
            }
            not_api_v1_patch_address:

            // api_v1_put_address
            if (preg_match('#^/addresses/(?P<id>[^/\\.]++)(?:\\.(?P<_format>xml|json|html))?$#s', $pathinfo, $matches) && ($context->getApiVersion() === "v1")) {
                if ($this->context->getMethod() != 'PUT') {
                    $allow[] = 'PUT';
                    goto not_api_v1_put_address;
                }

                return $this->mergeDefaults(array_replace($matches, array('_route' => 'api_v1_put_address')), array (  '_controller' => 'Acme\\DemoBundle\\Controller\\Api\\V1\\AddressController::putAddressAction',  '_format' => 'json',));
            }
            not_api_v1_put_address:

            // api_v1_delete_address
            if (preg_match('#^/addresses/(?P<id>[^/\\.]++)(?:\\.(?P<_format>xml|json|html))?$#s', $pathinfo, $matches) && ($context->getApiVersion() === "v1")) {
                if ($this->context->getMethod() != 'DELETE') {
                    $allow[] = 'DELETE';
                    goto not_api_v1_delete_address;
                }

                return $this->mergeDefaults(array_replace($matches, array('_route' => 'api_v1_delete_address')), array (  '_controller' => 'Acme\\DemoBundle\\Controller\\Api\\V1\\AddressController::deleteAddressAction',  '_format' => 'json',));
            }
            not_api_v1_delete_address:

        }

        if (0 === strpos($pathinfo, '/rights')) {
            // api_v1_get_rights
            if (preg_match('#^/rights(?:\\.(?P<_format>xml|json|html))?$#s', $pathinfo, $matches) && ($context->getApiVersion() === "v1")) {
                if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'HEAD'));
                    goto not_api_v1_get_rights;
                }

                return $this->mergeDefaults(array_replace($matches, array('_route' => 'api_v1_get_rights')), array (  '_controller' => 'Acme\\DemoBundle\\Controller\\Api\\V1\\RightController::getRightsAction',  '_format' => 'json',));
            }
            not_api_v1_get_rights:

            // api_v1_get_right
            if (preg_match('#^/rights/(?P<id>[^/\\.]++)(?:\\.(?P<_format>xml|json|html))?$#s', $pathinfo, $matches) && ($context->getApiVersion() === "v1")) {
                if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'HEAD'));
                    goto not_api_v1_get_right;
                }

                return $this->mergeDefaults(array_replace($matches, array('_route' => 'api_v1_get_right')), array (  '_controller' => 'Acme\\DemoBundle\\Controller\\Api\\V1\\RightController::getRightAction',  '_format' => 'json',));
            }
            not_api_v1_get_right:

        }

        // api_v1_get_contact_rights
        if (0 === strpos($pathinfo, '/contacts') && preg_match('#^/contacts/(?P<id>[^/]++)/rights(?:\\.(?P<_format>xml|json|html))?$#s', $pathinfo, $matches) && ($context->getApiVersion() === "v1")) {
            if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                $allow = array_merge($allow, array('GET', 'HEAD'));
                goto not_api_v1_get_contact_rights;
            }

            return $this->mergeDefaults(array_replace($matches, array('_route' => 'api_v1_get_contact_rights')), array (  '_controller' => 'Acme\\DemoBundle\\Controller\\Api\\V1\\RightController::getContactRightsAction',  '_format' => 'json',));
        }
        not_api_v1_get_contact_rights:

        if (0 === strpos($pathinfo, '/rights')) {
            // api_v1_post_right
            if (preg_match('#^/rights(?:\\.(?P<_format>xml|json|html))?$#s', $pathinfo, $matches) && ($context->getApiVersion() === "v1")) {
                if ($this->context->getMethod() != 'POST') {
                    $allow[] = 'POST';
                    goto not_api_v1_post_right;
                }

                return $this->mergeDefaults(array_replace($matches, array('_route' => 'api_v1_post_right')), array (  '_controller' => 'Acme\\DemoBundle\\Controller\\Api\\V1\\RightController::postRightAction',  '_format' => 'json',));
            }
            not_api_v1_post_right:

            // api_v1_patch_right
            if (preg_match('#^/rights/(?P<id>[^/\\.]++)(?:\\.(?P<_format>xml|json|html))?$#s', $pathinfo, $matches) && ($context->getApiVersion() === "v1")) {
                if ($this->context->getMethod() != 'PATCH') {
                    $allow[] = 'PATCH';
                    goto not_api_v1_patch_right;
                }

                return $this->mergeDefaults(array_replace($matches, array('_route' => 'api_v1_patch_right')), array (  '_controller' => 'Acme\\DemoBundle\\Controller\\Api\\V1\\RightController::patchRightAction',  '_format' => 'json',));
            }
            not_api_v1_patch_right:

            // api_v1_put_right
            if (preg_match('#^/rights/(?P<id>[^/\\.]++)(?:\\.(?P<_format>xml|json|html))?$#s', $pathinfo, $matches) && ($context->getApiVersion() === "v1")) {
                if ($this->context->getMethod() != 'PUT') {
                    $allow[] = 'PUT';
                    goto not_api_v1_put_right;
                }

                return $this->mergeDefaults(array_replace($matches, array('_route' => 'api_v1_put_right')), array (  '_controller' => 'Acme\\DemoBundle\\Controller\\Api\\V1\\RightController::putRightAction',  '_format' => 'json',));
            }
            not_api_v1_put_right:

            // api_v1_delete_right
            if (preg_match('#^/rights/(?P<id>[^/\\.]++)(?:\\.(?P<_format>xml|json|html))?$#s', $pathinfo, $matches) && ($context->getApiVersion() === "v1")) {
                if ($this->context->getMethod() != 'DELETE') {
                    $allow[] = 'DELETE';
                    goto not_api_v1_delete_right;
                }

                return $this->mergeDefaults(array_replace($matches, array('_route' => 'api_v1_delete_right')), array (  '_controller' => 'Acme\\DemoBundle\\Controller\\Api\\V1\\RightController::deleteRightAction',  '_format' => 'json',));
            }
            not_api_v1_delete_right:

        }

        if (0 === strpos($pathinfo, '/contacts')) {
            // api_v2_get_contacts
            if (preg_match('#^/contacts(?:\\.(?P<_format>xml|json|html))?$#s', $pathinfo, $matches) && ($context->getApiVersion() === "v2")) {
                if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'HEAD'));
                    goto not_api_v2_get_contacts;
                }

                return $this->mergeDefaults(array_replace($matches, array('_route' => 'api_v2_get_contacts')), array (  '_controller' => 'Acme\\DemoBundle\\Controller\\Api\\V2\\ContactController::getContactsAction',  '_format' => 'json',));
            }
            not_api_v2_get_contacts:

            // api_v2_get_contact
            if (preg_match('#^/contacts/(?P<id>[^/\\.]++)(?:\\.(?P<_format>xml|json|html))?$#s', $pathinfo, $matches) && ($context->getApiVersion() === "v2")) {
                if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'HEAD'));
                    goto not_api_v2_get_contact;
                }

                return $this->mergeDefaults(array_replace($matches, array('_route' => 'api_v2_get_contact')), array (  '_controller' => 'Acme\\DemoBundle\\Controller\\Api\\V2\\ContactController::getContactAction',  '_format' => 'json',));
            }
            not_api_v2_get_contact:

        }

        throw 0 < count($allow) ? new MethodNotAllowedException(array_unique($allow)) : new ResourceNotFoundException();
    }
}
