<?php

namespace App\Api\V1\Controllers;

use App\Api\V1\Models\User;
use App\Models\OperationLog;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Http\Controllers\Controller;
use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Exception\HttpResponseException;


class AuthController extends BaseController
{
    /**
     * The authentication guard that should be used.
     * @var string
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * 用户注册
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function postSignup(Request $request)
    {
        try {
            $this->validate($request, [
                'name' => 'required|min:3|max:20|unique:clients',
                'email' => 'required|email|max:50|unique:clients',
                'password' => 'required|min:8|max:20'
            ]);
        } catch (ValidationException $e) {
            return $e->getResponse();
        }
        $newUser = [
            'email' => $request->get('email'),
            'name' => $request->get('name'),
            'password' => bcrypt($request->get('password'))
        ];
        $user = User::create($newUser);
        $token = JWTAuth::fromUser($user);
        /* 注册日志 */
        $log = [
            'user' => 'guest',
            'path' => $request->path(),
            'method' => $request->method(),
            'ip' => $request->ip(),
            'input' => json_encode($request->all(), JSON_UNESCAPED_UNICODE),
        ];
        OperationLog::create($log);
        /* 注册日志 */
        return response()->json(['code' => 200, 'token' => $token], 200);
    }
    
    /**
     * 用户登录
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function postLogin(Request $request)
    {
        try {
            $this->validate($request, [
                'name' => 'required',
                'password' => 'required',
            ]);
        } catch (ValidationException $e) {
            return $e->getResponse();
        }

        /* 验证ldap服务器 */
        $username = $request->get('name');
        $password = $request->get('password');
        $ds = @ldap_connect('ldap://192.168.1.1', '389');
        @ldap_set_option($ds, LDAP_OPT_PROTOCOL_VERSION, 3);
        @ldap_set_option($ds, LDAP_OPT_REFERRALS, 0);
        if ( @ldap_bind($ds, "{$username}@nfw.com", $password) )
        {
            $result = @ldap_search($ds, 'dc=nfw,dc=com', "sAMAccountName={$username}", ['sAMAccountName','DisplayName']);
            $info = @ldap_get_entries($ds, $result);
            $realname = @$info['0']['displayname']['0'];
            $dn = @$info['0']['dn'];
            // 查询用户是否在本地存在, 不存在则添加; 存在则更新password;
            $user = User::where('name', $username)->first();
            if ( ! $user )
            {
                $newUser = [
                    'name' => $username,
                    'password' => bcrypt($password),
                    'udn' => $dn,
                    'email' => $username . '@southcn.com',
                    'realname' => $realname,
                    'flag' => '域用户',
                ];
                User::create($newUser);
            } else {
                $user->password = bcrypt($password);
                $user->save();
            }
        }
        

        try {
            // Attempt to verify the credentials and create a token for the user
            if ( ! $token = JWTAuth::attempt($this->getCredentials($request)) ) {
                return $this->onUnauthorized();
            }
        } catch (JWTException $e) {
            // Something went wrong while attempting to encode the token
            return $this->onJwtGenerationError();
        }

        // All good so return the token
        /* 登录日志 */
        $log = [
            'user' => $request->get('name'),
            'path' => $request->path(),
            'method' => $request->method(),
            'ip' => $request->ip(),
            'input' => json_encode($request->all(), JSON_UNESCAPED_UNICODE),
        ];
        OperationLog::create($log);
        /* 登录日志 */        
        return $this->onAuthorized($token);
    }

    /**
     * What response should be returned on invalid credentials.
     * @return JsonResponse
     */
    protected function onUnauthorized()
    {
        return new JsonResponse([
            'code' => 402,
            'message' => '无效的凭证'
        ], Response::HTTP_UNAUTHORIZED);
    }

    /**
     * What response should be returned on error while generate JWT.
     * @return JsonResponse
     */
    protected function onJwtGenerationError()
    {
        return new JsonResponse([
            'code' => 401,
            'message' => '创建token失败'
        ], Response::HTTP_INTERNAL_SERVER_ERROR);
    }

    /**
     * What response should be returned on authorized.
     * @return JsonResponse
     */
    protected function onAuthorized($token)
    {
        return new JsonResponse([
            'code' => 200,
            'message' => 'token生成成功',
            'data' => [
                'token' => $token,
            ]
        ]);
    }

    /**
     * Get the needed authorization credentials from the request.
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    protected function getCredentials(Request $request)
    {
        return $request->only('name', 'password');
    }

    /**
     * Invalidate a token.
     * @return \Illuminate\Http\Response
     */
    public function deleteInvalidate()
    {
        $token = JWTAuth::parseToken();
        $token->invalidate();
        return new JsonResponse(['code' => 200, 'message' => 'token删除成功']);
    }

    /**
     * Refresh a token.
     * @return \Illuminate\Http\Response
     */
    public function patchRefresh()
    {
        $token = JWTAuth::parseToken();
        $newToken = $token->refresh();

        return new JsonResponse([
            'code' => 200,
            'message' => 'token刷新成功',
            'data' => [
                'token' => $newToken
            ]
        ]);
    }

    /**
     * Get authenticated user.
     * @return \Illuminate\Http\Response
     */
    public function getUser()
    {
        return new JsonResponse([
            'code' => 200,
            'message' => '已授权的用户',
            'data' => JWTAuth::parseToken()->authenticate()
        ]);
    }

}
