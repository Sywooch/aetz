<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace common\authclient\clients;

use yii\authclient\OAuth2;

class Mailru extends OAuth2
{
    /**
     * @inheritdoc
     */
    public $authUrl = 'https://connect.mail.ru/oauth/authorize';
    /**
     * @inheritdoc
     */
    public $tokenUrl = 'https://connect.mail.ru/oauth/token';
    /**
     * @inheritdoc
     */
    public $apiBaseUrl = 'http://www.appsmail.ru/platform/api';

    /**
     * @inheritdoc
     */
    protected function defaultName()
    {
        return 'mailru';
    }

    /**
     * @inheritdoc
     */
    protected function initUserAttributes()
    {
        $options = $this->initOptions();
        $attributes = $this->api('users.getInfo', 'GET', $options);

        return array_shift($attributes);
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
    protected function defaultTitle()
    {
        return 'Mail.ru';
    }

    protected function initOptions()
    {
        $token = $this->getAccessToken();

        $options['app_id'] = $this->clientId;
        $options['method'] = 'users.getInfo';
        $options['secure'] = 1;
        $options['session_key'] = $token->params['access_token'];
        $options['format'] = 'xml';

        $params = '';
        ksort($options);

        foreach ($options as $k => $v) {
            $params .= $k . '=' . $v;
        }

        $options['sig'] = md5($params . $this->clientSecret);

        return $options;
    }

}
