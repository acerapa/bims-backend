<?php header('Access-Control-Allow-Origin: *'); ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Chatbox Plugin - Lipreso Software Solutions</title>
</head>
<body>
    <div class="jl-plugin-chatbox">
        <div class="jl-plugin-header">
            <div class="d-flex justify-content-between align-items-center">
                <div class="jl-plugin-name">Lipreso Jason</div>
                <div class="d-flex jl-plugin-option">
                    <svg xmlns="http://www.w3.org/2000/svg" height="30" viewBox="0 96 960 960" fill="white" width="30"><path d="m283 711-43-43 240-240 240 239-43 43-197-197-197 198Z"/></svg>
                    <svg xmlns="http://www.w3.org/2000/svg" height="30" viewBox="0 96 960 960" fill="white" width="30"><path d="M480 711 240 471l43-43 197 198 197-197 43 43-240 239Z"/></svg>
                </div>
            </div>
        </div>
        <div class="jl-plugin-body">
            
        </div>
        <div class="jl-plugin-footer">
            <div class="left">
                <textarea class="js-klnmxcvazdcsw"></textarea>
            </div>
            <div class="right">
                <div class="send js-vbfgxcvzxcsde" title="Send Message">
                    <svg xmlns="http://www.w3.org/2000/svg" height="20" viewBox="0 96 960 960" width="20" fill="white"><path d="M120 896V256l760 320-760 320Zm60-93 544-227-544-230v168l242 62-242 60v167Zm0 0V346v457Z"/></svg>
                </div>
            </div>
        </div>
    </div>
</body>
</html>





<style>
    .jl-plugin-chatbox { position: fixed;background-color: white;border-radius: 10px;overflow: hidden; z-index: 100000; }
    .jl-plugin-chatbox .jl-plugin-header {position: relative; width:100%;height:50px;background-color:white; }
    .jl-plugin-name { line-height: 50px; color:white;padding: 0px 20px; }
    .jl-plugin-option { padding-right:20px; }
    .jl-plugin-chatbox .jl-plugin-body {position: relative; width:100%;height:450px;background-color:white; }
    .jl-plugin-chatbox .jl-plugin-footer {position: relative; width:100%;height:100px;background-color:white;display:flex; }
    .jl-plugin-chatbox .jl-plugin-footer .left { width: calc(100% - 50px);box-sizing:border-box;padding-left:10px }
    .jl-plugin-chatbox .jl-plugin-footer .left textarea { width:100%;height:100px; }
    .jl-plugin-chatbox .jl-plugin-footer .right { width: 50px; }
    .jl-plugin-chatbox .jl-plugin-footer .right .send { cursor:pointer;background-color:#448aff;margin: 0px 5px;border-radius:4px; }
    .jl-plugin-chatbox .jl-plugin-footer .right .send svg { display:block;margin:0 auto; }
    
    @media only screen and (max-width: 600px) {
        .jl-plugin-chatbox { bottom: 10px; right: 10px; width: calc(100% - 20px); height: 600px; }
    }

    @media only screen and (min-width: 600px) {
        .jl-plugin-chatbox { bottom: 10px; right: 10px; width: 400px; height: 600px; }
    }

    @media only screen and (min-width: 768px) {
        
    }

    @media only screen and (min-width: 992px) {
        
    }

    @media only screen and (min-width: 1200px) {
        
    } 
</style>
