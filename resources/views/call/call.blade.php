@extends('layouts.app')

@section('title')
Chamada {{$call->id}}
@endsection

@section('content')
<div align="center"> 
    <h6  style="text-transform: uppercase" class="text-orange">Seja bem vindo a chamada com {{$call->user->name}}</h6>
    <span style="width:100px;" class="badge <?php echo $call->getCallColor()?>">{{$call->getCallStatus()}}</span>
</div>
@endsection  

@section('chat')
<div class="col-lg-6 chat">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title box-title">Chat com {{$call->getUserName()}}</h4>
                            <div class="card-content">
                                <div id="messenger-box" class="messenger-box card-overflow-y">
                                <h6 id="empty-chat" class="card-subtitle mb-2 text-muted">Ops! Vocês ainda não mandaram nenhuma mensagem =(</h6>
                                </div><!-- /.messenger-box -->
                                <div class="send-mgs">
                                        <div class="yourmsg">
                                            <input id="input-msg" class="form-control" type="text">
                                        </div>

                                        <button type="button" id="btn-msg" class="msg-send-btn">
                                            <div class="row">    
                                                <i class="now-ui-icons ui-1_send"></i>
                                            </div>
                                        </button>
                                    </div>
                            </div>
                        </div> <!-- /.card-body -->
                        <div class="footer-inner bg-white">
                        <div class="row">
                            <div class="col-sm-6">
                                Copyright &copy; 2018 Ela Admin
                            </div>
                            <div class="col-sm-6 text-right">
                                Designed by <a target="_blank" href="https://colorlib.com">Colorlib</a>
                            </div>
                        </div>
                    </div>
                    </div><!-- /.card -->
                </div>
@endsection

@section('scripts')
<script>
    $(document).ready(() => {
        scrollTopAnimated();

        $('#btn-msg').click( (e) => {
           if($('#input-msg').val().length > 0){
                connectSendBird(true);
           } else {
               alert("Sua mensagem não pode ser vazia!");
           }
        });

        sb = new SendBird({appId: "678D4FF2-D756-419C-8664-443E7F3BC7ED"});
        <?php if(!$user->has_sendbird) { ?>
            var photo = 'https://image.flaticon.com/icons/svg/1500/1500374.svg';
            
            if('<?php echo $user->type?>' == 'B'){
                photo = 'https://image.flaticon.com/icons/svg/1809/1809651.svg';
            }

            if('<?php echo $user->type?>' == 'C'){
                photo = 'https://image.flaticon.com/icons/svg/1087/1087804.svg';
            }

            var d = {
               "user_id" : <?php echo $user->id?>,
			   "nickname" : "<?php echo $user->name?>",
			   "profile_url" : photo
            };

            var jsond = JSON.stringify(d);
            $.ajax({
                url : "https://api-678D4FF2-D756-419C-8664-443E7F3BC7ED.sendbird.com/v3/users",
                type : 'post',
                headers: {
                'Api-Token': "f7dfe57194880c5c949dfc0673dcb5847c02422b",
                'content-Type': "application/json; charset=utf-8",
                },
                dataType: "json",
                // contentType: "application/json; charset=utf-8",
                data : jsond,
            }).done((data) => {
                $.ajaxSetup({
                headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
                });
                $.ajax({
                url : "<?php echo url('/user/sendbird')?>",
                type : 'post',
            })
            }).fail((error) => {
                console.log(error);
            });
        <?php } ?>
        
        <?php 
            $access_t = substr(md5(rand(0,9999).rand(0,9999)),0,8);
            if($call->access_code){
                $access_t = $call->access_code;
            }
        ?>
        <?php if(!$call->channel_url){ ?>
            var d = {
                "name" : "<?php echo $call->id?>",
                "access_code" : "<?php echo $access_t?>",
                "is_public" : "true"
                };

            var jsond = JSON.stringify(d);
            
            $.ajax({
                    url : "https://api-678D4FF2-D756-419C-8664-443E7F3BC7ED.sendbird.com/v3/group_channels",
                    type : 'post',
                    headers: {
                    'Api-Token': "f7dfe57194880c5c949dfc0673dcb5847c02422b",
                    'content-Type': "application/json; charset=utf-8",
                    },
                    dataType: "json",
                    // contentType: "application/json; charset=utf-8",
                    data : jsond,
                }).done((r) => {
                    $.ajaxSetup({
                    headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                    });
                    $.ajax({
                    url : "<?php echo url('/user/createChannel')?>",
                    type : 'post',
                    data: {call_id : <?php echo $call->id?> , channel_url : r.channel_url, access_code: "<?php echo $access_t?>"}
                });
                document.location.reload(true);
                }).fail((e) => {
                    console.log(e);
            });
        <?php } ?>
            <?php if ($call->channel_url) { ?>
                var c_url = "<?php echo $call->channel_url ?>" 
            <?php } ?>

            <?php if ($call->access_code) { ?>
                var c_a_code = "<?php echo $call->access_code ?>" 
            <?php } ?>
            
            var d = {
                "user_id" : "<?php echo $user->id?>",
                "access_code" : c_a_code
                };

            var jsond = JSON.stringify(d);
            var url = "https://api-678D4FF2-D756-419C-8664-443E7F3BC7ED.sendbird.com/v3/group_channels/"+c_url+"/join";
    
            $.ajax({
                    url : url,
                    type : 'put',
                    headers: {
                    'Api-Token': "f7dfe57194880c5c949dfc0673dcb5847c02422b",
                    'content-Type': "application/json; charset=utf-8",
                    },
                    dataType: "json",
                    // contentType: "application/json; charset=utf-8",
                    data : jsond,
                }).done((r) => {
                   
                }).fail( e =>{console.log(e)});
                connectSendBird();
                attMessages();
    });
    


    connectSendBird = (send_msg = false) => {
        sb.connect("<?php echo $user->id?>","<?php echo $call->access_token?>", function(user, error) {
        const params = new sb.UserMessageParams();
        if(send_msg){
            params.message =  $('#input-msg').val();
        } 
        
        var channelListQuery = sb.GroupChannel.createMyGroupChannelListQuery();
        channelListQuery.includeEmpty = true;
        channelListQuery.order = 'latest_last_message'; // 'chronological', 'latest_last_message', 'channel_name_alphabetical', and 'metadata_value_alphabetical'

        if (channelListQuery.hasNext) {
            channelListQuery.next(function(channelList, error) {
                if (error) {
                    return;
                }

                channelList.forEach(c => {
                    var is_call_channel = c.url.localeCompare("<?php echo $call->channel_url?>");
                    if(is_call_channel == 0) {
                        callChannel = c; 
                    }
                });

                if(!send_msg) {
                    loadInitialMessages();
                }

                if(callChannel && send_msg){
                    callChannel.sendUserMessage(params, function(message, error) {
                    if (error) {
                        return;
                    }
                    $('#input-msg').val('');
                    var msg = message.message;
                    var uid = -1;
                    var html_msg = null;
                    profile_url = null;

                    if(message._sender){
                        uid = message._sender.userId;
                        profile_url = message._sender.profileUrl;
                    }

                    if(uid == "<?php echo $user->id?>"){
                        var html_msg = getSendHTMLMessages("<?php echo $user->name?>",msg,profile_url,timeConverter(message.createdAt));    
                    }

                    if(html_msg){
                        $("#empty-chat").remove();
                        $("#messenger-box").append(html_msg);
                    }
                    });
                }
            });
        }

    });
    }

    attMessages = () => {
        var ChannelHandler = new sb.ChannelHandler();
        ChannelHandler.onMessageReceived = function(channel, message) {   
            var msg = message.message;
            var uid = -1;
            var html_msg = null;
            var profile_url = "https://image.flaticon.com/icons/svg/1500/1500374.svg";

            if(message._sender){
                uid = message._sender.userId;
                profile_url = message._sender.profileUrl;
            }

            if(uid == "<?php echo $call->user->id?>"){
                var html_msg = getReceivedHTMLMessages("<?php echo $call->getUserName()?>",msg,profile_url,timeConverter(message.createdAt));    
            }

            if(uid == -1) {
                var html_msg = getReceivedHTMLMessages("Administrador",msg,profile_url,timeConverter(message.createdAt)); 
            }

            if(html_msg){
                $("#empty-chat").remove();
                $("#messenger-box").append(html_msg);
            }


        };
        <?php $hash = substr(md5(rand(0,9999).rand(0,99999).rand(0,99999)),0,10)?>
        var handler_id = "Call_"+"<?php echo $call->id?>"+"_"+"<?php echo $hash?>";
        
        sb.addChannelHandler(handler_id, ChannelHandler);

    }

    loadInitialMessages = () => {
        // There should only be one single instance per channel view.
        var prevMessageListQuery = callChannel.createPreviousMessageListQuery();
        prevMessageListQuery.limit = 50;
        prevMessageListQuery.reverse = false;

        // Retrieving previous messages.
        prevMessageListQuery.load(function(messages, error) {
            if (error) {
                return;
            }
            messages.forEach(m => {
                var uid = -1;
                var msg = m.message;
                var username = "Administrador";
                var type_msg = null;
                var profile_url = "https://image.flaticon.com/icons/svg/1500/1500374.svg";
                
                if(m._sender){
                    uid = m._sender.userId;
                    profile_url = m._sender.profileUrl;
                }

                if(uid == "<?php echo $user->id?>"){
                    username = "<?php echo $user->name?>";
                    type = 'S';
                }
                
                if(uid == "<?php echo $call->user->id?>") {
                    username = "<?php echo $call->getUserName()?>";
                    type = 'R';
                }

                if(type && type == 'S') {
                    var html_message = getSendHTMLMessages(username,msg,profile_url,timeConverter(m.createdAt));
                }

                if(type && type == 'R'){
                    var html_message = getReceivedHTMLMessages(username,msg,profile_url,timeConverter(m.createdAt));
                }

                if(uid == -1){
                    var html_message = getReceivedHTMLMessages(username,msg,profile_url,timeConverter(m.createdAt));
                }

                $("#empty-chat").remove();
                $("#messenger-box").append(html_message);

            });
        });
            }
        
        getReceivedHTMLMessages = (username,msg,profile_url,date) => {
            var received_msg_html = '<ul><li><div class="msg-received msg-received-call msg-container"><div class="avatar">'+
            '<img src="'+profile_url+'" alt="">'+
            '<div class="send-time">'+date+'</div></div><div class="msg-box"><div class="inner-box"> <div class="name">'+
            username + '</div><div class="meg">'+msg+'</div></div></div></div></li></ul>';
            return received_msg_html;
        }

        getSendHTMLMessages = (username,msg,profile_url,date) => {
            var send_msg_html = '<ul><li><div class="msg-sent msg-sent-call msg-container"><div class="avatar">'+
            '<img src="'+profile_url+'" alt="">'+
            '<div class="send-time">'+date+'</div></div><div class="msg-box"><div class="inner-box"> <div class="name">'+
            username + '</div><div class="meg">'+msg+'</div></div></div></div></li></ul>';
            return send_msg_html;
        }

        scrollTopAnimated = () => { 
            var scroll = $("#messenger-box");
            var totalOverflow = scroll.css('width');
            var toverflow = totalOverflow.split('px');
            $("#messenger-box").animate( 
                { scrollTop: toverflow[0] }, 1000);   
        } 

        timeConverter = (UNIX_timestamp) => {
            var a = new Date(UNIX_timestamp);
            var months = ['Jan','Fev','Mar','Abr','Mai','Jun','Jul','Ago','Set','Out','Nov','Dez'];
            var year = a.getFullYear();
            var month = months[a.getMonth()];
            var date = a.getDate();
            var hour = a.getHours();
            var min = a.getMinutes();
            var sec = a.getSeconds();
            var time = date + ' ' + month + ' ' + year + ' ' + hour + ':' + min + ':' + sec ;
            return time;
        }

</script>
@endsection 
