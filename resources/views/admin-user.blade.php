<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="/css/bootstrap.min.css" rel="stylesheet">
    <script src="/js/bootstrap.bundle.min.js"></script>
    <title>Kanade</title>
</head>
<body>
    @include("nav")
<main>
    <div class="row">
        <div class="container col-10 p-5 my-5 border">
            <div class="row">
                <div class="col align-self-start">
                    <div class="h3">用户管理</div>
                </div>
                <div class="col align-self-end">
                    <div class="row">
                        <div class="col-8 form-floating">
                            <input type="text" class="form-control" id="nameSearc" placeholder="搜索一个名字" style="height: 80%;">
                            <label for="nameSearc" style="height: 80%;">姓名搜索</label>
                        </div>
                        <button class="col-2 btn btn-primary" style="height: 80%;">
                            搜索
                        </button>
                        <button class="col-2 btn btn-success" style="height: 80%;width: 10%;" data-bs-toggle="modal" data-bs-target="#add">
                            +
                        </button>
                    </div>
                </div>
            </div>
            <table class="table border text-center">
                <thead>
                    <tr>
                        <th>Uid</th>
                        <th>姓名</th>
                        <th>委员会</th>
                        <th>用户组</th>
                        <th>操作</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td scope="row">1</td>
                        <td><a href="http://reimu.nbmun.cn/s/1">曹峰</a></td>
                        <td>群星联动委员会</td>
                        <td>DH</td>
                        <td class="row align-items-center">
                            <div class="col-3"></div>
                            <button class="col-3 btn btn-primary" data-bs-toggle="modal" data-bs-target="#sarch">修改</button>
                            <button class="col-3 btn btn-danger">删除</button>
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="modal fade" id="sarch" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                            <div class="modal-header">
                                    <h5 class="modal-title">用户组修改</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                        <div class="modal-body">
                            <div class="container-fluid">
                                <div class="mb-3">
                                    <div class="mb-3">
                                        <label for="userGroup" class="form-label">用户组</label>
                                        <select class="form-control" name="userGroup" id="userGroup">
                                            <option>DH</option>
                                            <option>DM</option>
                                            <option>代表</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">关闭</button>
                            <button type="button" class="btn btn-primary" data-bs-dismiss="modal">保存</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                            <div class="modal-header">
                                    <h5 class="modal-title">管理员添加</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                        <div class="modal-body">
                            <div class="container-fluid">
                                <div class="mb-3 row">
                                    <div class="col-4 mb-3">
                                        <label for="name" class="form-label"></label>
                                        <input type="text" name="name" id="name" class="form-control" placeholder="姓名搜索" aria-describedby="helpId">
                                    </div>
                                    <div class="col-4 mb-3">
                                      <label for="phone" class="form-label"></label>
                                      <input type="text" class="form-control" name="phone" id="phone" aria-describedby="helpId" placeholder="手机号搜索">
                                    </div>
                                    <div class="col-4 mb-3">
                                        <label for="email" class="form-label"></label>
                                        <input type="email" class="form-control" name="email" id="email" aria-describedby="helpId" placeholder="邮箱搜索">
                                    </div>
                                    <div class="col-10"></div>
                                    <button type="button" class="btn btn-primary col-2">搜索</button>
                                </div>
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item">
                                        <div class="row">
                                            <div class="col-6 border">
                                                <img src="http://reimu.nbmun.cn/s/1/storage/avatar/1.gif">曹峰
                                            </div>
                                            <div class="col-2"></div>
                                            <div class="col-4">
                                                <select class="form-control" name="userGroup" id="userGroup">
                                                    <option>DH</option>
                                                    <option>DM</option>
                                                    <option>代表</option>
                                                </select>
                                        </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">关闭</button>
                            <button type="button" class="btn btn-primary" data-bs-dismiss="modal">保存</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>  
</main>
    @include("footbar")
    <?php

    ?>
</body>
</html>