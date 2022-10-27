
//Libraries used in project
const path = require('path'),
      fs = require('fs'),
      https = require('https'),
      express = require('express'),
      ejs = require('ejs'),
      os = require('os'),
      opn = require('open');



var port = 8000; //port for local host


var apiroot = 'http://localhost:8080/api'; //address to

//Optional Dev variable to iniciate a different homepage
var devpage = "index";

/*
    Depending on the users/employee information the appropriate screens can be initiated.
    For ex:
        client grantv is a sales consultant for department 350. when he opens the app the
        first screen he will see is the residential dashboard, and all of the bids that
        he has been working on will show in a list and be available to load.
*/

//Create server and save to app
var app = express();

//MIDDLE WARE AND SETUP
app.use(express.static(path.join(__dirname,'SBBin'))); //for resouce files
app.set('views',path.join(__dirname, 'SB')); //display views
app.set('view engine','ejs'); //setup ejs as viewing engine
//may not need the following when using express with ejs
app.use(express.urlencoded({extended:true}));
app.use(express.json());

///////////////////////

// ROUTES ////////////////////////////////////////////////////
/*
    For the dev purposes, when developing a web page simply
     include a get() with the path to the page. Navigation to
     the page can then be through the address bar from localhost
*/

app.get('/',(req,res)=>{//Home page
    /*
        Before serving the home page check to see if the user is authorized to be on the app.
        This is done by using the name found in clients C:/Users/ChristianV.VOGELHEATING (OR if not just christianv).
    */
    if(devpage != null){
        res.render(devpage);
    }else{
    res.render('index');
    }
});

app.get('/login',(req,res)=>{
  res.render('admin/loginform');
});

//////////////////////////////////////////////////////////////

//On open, navigate to the home page
//opn('http://localhost:8080') //to autoload the homescreen of the app


app.listen(port,(err)=>{//setup listening on localhost:port
    if(err){
        throw err;
    }else{
        console.log('VHC running on ' + port + '.....');
    }
});
