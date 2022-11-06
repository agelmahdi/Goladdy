<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
    </head>
    <body>
        
            <h1>Create a Restful API based on Laravel version 9. </h1>
                <h3>The API should have two endpoints with the below description:</h3>

            <h4><span style="color:green">Done ^_^;</span>  PUT /status/store_avilability_zone, which finds the Availability zone on which the EC2 instances runs, and stores that value into MySQL Database along with Instance ID and timestamp.</h4> 
            <h4><a href="">http://127.0.0.1/api/status/store_avilability_zone/instance_id/avilability_zone</a></h4>
            <h3>To attache or store avilability zone alone with Instance; <span style="color:rgb(97, 78, 218)">Please note that use postman with put method </span></h3>
            <h5>1. To store new instance and new availibility zone change instance_id parameter and avilability_zone </h5>
            <h4><a href="">http://127.0.0.1/api/status/store_avilability_zone/new_instance/new_avilability_zone</a></h4>
            <h5>2. To attach new instance to current availibility zone change instance_id parameter</h5>
            <h4><a href="">http://127.0.0.1/api/status/store_avilability_zone/new_instance/current_avilability_zone</a></h4>
            <h5>3. To attach new availibility zone to current instance change availibility zone parameter</h5>
            <h4><a href="">http://127.0.0.1/api/status/store_avilability_zone/current_instance/new_avilability_zone</a></h4>

            <h4><span style="color:green">Done ^_^;</span>  GET /status/view_zone_history, which lists the data stored in the MySQL Database in JSON.</h4>

            <h4><a href="http://127.0.0.1/api/status/view_zone_history">http://127.0.0.1/api/status/view_zone_history <span style="color:blue">View History</span> </a></h4>

            <h3>To be easy to test your work, we expect to find the following in the GitHub repo:</h3>
            
            <h4><span style="color:green">Done ^_^;</span> A containerized setup (Dockerfile)</h4>
            <h3>Open a terminal at a project folder and past 'cp .env.example .env' and at .docker 'cp .env.example .env', then return to project folder and run<span style="color:rgb(97, 78, 218)"> 'bash run.sh'</span></h3>
            <h4><span style="color:green">Done ^_^;</span> Database structure (DDL, i.e., data.sql) <span style="color:rgb(97, 78, 218)">Kindly check 'goladdyEER.mwb' at project folder</span></h4>
            <h4><span style="color:green">Done ^_^;</span> A way to pass the database details like username and password to the container at run time.</h4>

            <h1 style="color:blue"> All Done !! I'm looking forward to hearing from you soon :)</h1>
    </body>
</html>