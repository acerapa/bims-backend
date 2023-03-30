<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Laravel</title>
    </head>
    
    <body>
        <table>
            <tr>
                <th>Project</th>
                <th>Domain</th>
                <th>Set Env</th>
            </tr>
            <tr>
                <td>Mcrich</td>
                <td><a target="_blank" href="http://127.0.0.1:8000/api/plugin_project_config/setProjectEnv/mcrichtravel.com">www.mcrichtravel.com</a></td>
            </tr>
            <tr>
                <td>Deanlief</td>
                <td><a target="_blank" href="http://127.0.0.1:8000/api/plugin_project_config/setProjectEnv/deanleifproperties.com">www.deanleifproperties.com</a></td>
            </tr>
            <tr>
                <td>Foxcity</td>
                <td><a target="_blank" href="http://127.0.0.1:8000/api/plugin_project_config/setProjectEnv/foxcityph.tech">www.foxcityph.tech</a></td>
            </tr>
            <tr>
                <td>Flipcard</td>
                <td><a target="_blank" href="http://127.0.0.1:8000/api/plugin_project_config/setProjectEnv/flipcard.fun">www.flipcard.fun</a></td>
            </tr>
            <tr>
                <td></td>
                <td><a target="_blank" href="http://127.0.0.1:8000/api/plugin_project_config/setProjectEnv/jasonlipreso.fun">www.jasonlipreso.fun</a></td>
            </tr>
        </table>
    </body>
</html>

<style>
table { font-family: Arial, Helvetica, sans-serif; border-collapse: collapse; width: 100%;}
table td, table th {border: 1px solid #ddd;padding: 8px;}
table tr:nth-child(even){background-color: #f2f2f2;}
table tr:hover {background-color: #ddd;}
table th {padding-top: 12px;padding-bottom: 12px;text-align: left;background-color: #04AA6D;color: white;}
</style>
