<?php
/**
 * @author      Haydar KULEKCI <haydarkulekci@gmail.com>
 * @copyright   Copyright (c) Haydar KULEKCI
 * @license     http://mit-license.org/
 *
 * @link        https://github.com/biberlabs/zend-expressive-oauth2-server
 */

namespace OAuth2Server\Entity;

use League\OAuth2\Server\Entities\AccessTokenEntityInterface;
use Doctrine\ORM\Mapping as ORM;
use League\OAuth2\Server\Entities\ScopeEntityInterface;


/**
 * @ORM\Table(name="oauth_access_token")
 * @ORM\Entity(repositoryClass="OAuth2Server\Repository\AccessTokenRepository")
 */
class AccessToken implements AccessTokenEntityInterface
{
    use AccessTokenTrait, TokenEntityTrait, EntityTrait;

    /**
     * @var ScopeEntityInterface[]
     *
     * @ORM\ManyToMany(targetEntity="OAuth2Server\Entity\Scope", inversedBy="accessTokens")
     * @ORM\JoinTable(name="access_token_scopes",
     *     joinColumns={@ORM\JoinColumn(name="scope_id", referencedColumnName="identifier")},
     *     inverseJoinColumns={@ORM\JoinColumn(name="access_token_scope_id", referencedColumnName="identifier")}
     *     )
     */
    protected $scopes = [];
    
}
