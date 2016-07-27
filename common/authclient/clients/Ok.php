<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace common\authclient\clients;

use yii\authclient\OAuth2;

class Ok extends OAuth2
{
    /**
     * @inheritdoc
     */
    public $authUrl = 'http://www.odnoklassniki.ru/oauth/authorize';
    /**
     * @inheritdoc
     */
    public $tokenUrl = 'http://api.odnoklassniki.ru/oauth/token.do';
    /**
     * @inheritdoc
     */
    public $apiBaseUrl = 'http://api.odnoklassniki.ru/fb.do';


    /**
     * @inheritdoc
     */
    protected function initUserAttributes()
    {
        $options = $this->initOptions();
        $attributes = $this->api($this->apiBaseUrl, 'GET', $options);

        return $attributes;
    }

    /**
     * @inheritdoc
     */
    protected function defaultNormalizeUserAttributeMap()
    {
        return [
            'id' => 'uid',
        ];
    }

    /**
     * @inheritdoc
     */
    protected function defaultName()
    {
        return 'odnoklassniki';
    }

    /**
     * @inheritdoc
     */
    protected function defaultTitle()
    {
        return 'Ok.ru';
    }

    /**
     * @inheritdoc
     */
    protected function initOptions()
    {

        $token = $this->getAccessToken();

        $accessToken = $token->params['access_token'];

        $options['method'] = 'users.getCurrentUser';
        $options['format'] = 'JSON';
        $options['application_key'] = 'CBAJBDJDEBABABABA';
        $options['client_id'] = $this->clientId;

        $params = '';
        ksort($options);

        foreach ($options as $k => $v) {
            $params .= $k . '=' . $v;
        }

        $options['sig'] = md5($params . md5($accessToken . $this->clientSecret));
        $options['access_token'] = $accessToken;

        return $options;
    }
}
