<?php

namespace Proxies\__CG__\GestionFraisBundle\Entity;

/**
 * DO NOT EDIT THIS FILE - IT WAS CREATED BY DOCTRINE'S PROXY GENERATOR
 */
class LigneFraisHorsForfait extends \GestionFraisBundle\Entity\LigneFraisHorsForfait implements \Doctrine\ORM\Proxy\Proxy
{
    /**
     * @var \Closure the callback responsible for loading properties in the proxy object. This callback is called with
     *      three parameters, being respectively the proxy object to be initialized, the method that triggered the
     *      initialization process and an array of ordered parameters that were passed to that method.
     *
     * @see \Doctrine\Common\Persistence\Proxy::__setInitializer
     */
    public $__initializer__;

    /**
     * @var \Closure the callback responsible of loading properties that need to be copied in the cloned object
     *
     * @see \Doctrine\Common\Persistence\Proxy::__setCloner
     */
    public $__cloner__;

    /**
     * @var boolean flag indicating if this object was already initialized
     *
     * @see \Doctrine\Common\Persistence\Proxy::__isInitialized
     */
    public $__isInitialized__ = false;

    /**
     * @var array properties to be lazy loaded, with keys being the property
     *            names and values being their default values
     *
     * @see \Doctrine\Common\Persistence\Proxy::__getLazyProperties
     */
    public static $lazyPropertiesDefaults = array();



    /**
     * @param \Closure $initializer
     * @param \Closure $cloner
     */
    public function __construct($initializer = null, $cloner = null)
    {

        $this->__initializer__ = $initializer;
        $this->__cloner__      = $cloner;
    }







    /**
     * 
     * @return array
     */
    public function __sleep()
    {
        if ($this->__isInitialized__) {
            return array('__isInitialized__', '' . "\0" . 'GestionFraisBundle\\Entity\\LigneFraisHorsForfait' . "\0" . 'num', '' . "\0" . 'GestionFraisBundle\\Entity\\LigneFraisHorsForfait' . "\0" . 'idVisiteur', '' . "\0" . 'GestionFraisBundle\\Entity\\LigneFraisHorsForfait' . "\0" . 'mois', '' . "\0" . 'GestionFraisBundle\\Entity\\LigneFraisHorsForfait' . "\0" . 'idEtatLigneFrais', '' . "\0" . 'GestionFraisBundle\\Entity\\LigneFraisHorsForfait' . "\0" . 'date', '' . "\0" . 'GestionFraisBundle\\Entity\\LigneFraisHorsForfait' . "\0" . 'montant', '' . "\0" . 'GestionFraisBundle\\Entity\\LigneFraisHorsForfait' . "\0" . 'libelleLigneHorsForfait');
        }

        return array('__isInitialized__', '' . "\0" . 'GestionFraisBundle\\Entity\\LigneFraisHorsForfait' . "\0" . 'num', '' . "\0" . 'GestionFraisBundle\\Entity\\LigneFraisHorsForfait' . "\0" . 'idVisiteur', '' . "\0" . 'GestionFraisBundle\\Entity\\LigneFraisHorsForfait' . "\0" . 'mois', '' . "\0" . 'GestionFraisBundle\\Entity\\LigneFraisHorsForfait' . "\0" . 'idEtatLigneFrais', '' . "\0" . 'GestionFraisBundle\\Entity\\LigneFraisHorsForfait' . "\0" . 'date', '' . "\0" . 'GestionFraisBundle\\Entity\\LigneFraisHorsForfait' . "\0" . 'montant', '' . "\0" . 'GestionFraisBundle\\Entity\\LigneFraisHorsForfait' . "\0" . 'libelleLigneHorsForfait');
    }

    /**
     * 
     */
    public function __wakeup()
    {
        if ( ! $this->__isInitialized__) {
            $this->__initializer__ = function (LigneFraisHorsForfait $proxy) {
                $proxy->__setInitializer(null);
                $proxy->__setCloner(null);

                $existingProperties = get_object_vars($proxy);

                foreach ($proxy->__getLazyProperties() as $property => $defaultValue) {
                    if ( ! array_key_exists($property, $existingProperties)) {
                        $proxy->$property = $defaultValue;
                    }
                }
            };

        }
    }

    /**
     * 
     */
    public function __clone()
    {
        $this->__cloner__ && $this->__cloner__->__invoke($this, '__clone', array());
    }

    /**
     * Forces initialization of the proxy
     */
    public function __load()
    {
        $this->__initializer__ && $this->__initializer__->__invoke($this, '__load', array());
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __isInitialized()
    {
        return $this->__isInitialized__;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __setInitialized($initialized)
    {
        $this->__isInitialized__ = $initialized;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __setInitializer(\Closure $initializer = null)
    {
        $this->__initializer__ = $initializer;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __getInitializer()
    {
        return $this->__initializer__;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __setCloner(\Closure $cloner = null)
    {
        $this->__cloner__ = $cloner;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific cloning logic
     */
    public function __getCloner()
    {
        return $this->__cloner__;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     * @static
     */
    public function __getLazyProperties()
    {
        return self::$lazyPropertiesDefaults;
    }

    
    /**
     * {@inheritDoc}
     */
    public function setNum($num)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setNum', array($num));

        return parent::setNum($num);
    }

    /**
     * {@inheritDoc}
     */
    public function getNum()
    {
        if ($this->__isInitialized__ === false) {
            return (int)  parent::getNum();
        }


        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getNum', array());

        return parent::getNum();
    }

    /**
     * {@inheritDoc}
     */
    public function setIdVisiteur($idVisiteur)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setIdVisiteur', array($idVisiteur));

        return parent::setIdVisiteur($idVisiteur);
    }

    /**
     * {@inheritDoc}
     */
    public function getIdVisiteur()
    {
        if ($this->__isInitialized__ === false) {
            return (int)  parent::getIdVisiteur();
        }


        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getIdVisiteur', array());

        return parent::getIdVisiteur();
    }

    /**
     * {@inheritDoc}
     */
    public function setMois($mois)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setMois', array($mois));

        return parent::setMois($mois);
    }

    /**
     * {@inheritDoc}
     */
    public function getMois()
    {
        if ($this->__isInitialized__ === false) {
            return  parent::getMois();
        }


        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getMois', array());

        return parent::getMois();
    }

    /**
     * {@inheritDoc}
     */
    public function setIdEtatLigneFrais($idEtatLigneFrais)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setIdEtatLigneFrais', array($idEtatLigneFrais));

        return parent::setIdEtatLigneFrais($idEtatLigneFrais);
    }

    /**
     * {@inheritDoc}
     */
    public function getIdEtatLigneFrais()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getIdEtatLigneFrais', array());

        return parent::getIdEtatLigneFrais();
    }

    /**
     * {@inheritDoc}
     */
    public function setDate($date)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setDate', array($date));

        return parent::setDate($date);
    }

    /**
     * {@inheritDoc}
     */
    public function getDate()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getDate', array());

        return parent::getDate();
    }

    /**
     * {@inheritDoc}
     */
    public function setMontant($montant)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setMontant', array($montant));

        return parent::setMontant($montant);
    }

    /**
     * {@inheritDoc}
     */
    public function getMontant()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getMontant', array());

        return parent::getMontant();
    }

    /**
     * {@inheritDoc}
     */
    public function setLibelleLigneHorsForfait($libelleLigneHorsForfait)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setLibelleLigneHorsForfait', array($libelleLigneHorsForfait));

        return parent::setLibelleLigneHorsForfait($libelleLigneHorsForfait);
    }

    /**
     * {@inheritDoc}
     */
    public function getLibelleLigneHorsForfait()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getLibelleLigneHorsForfait', array());

        return parent::getLibelleLigneHorsForfait();
    }

}
