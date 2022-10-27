/* NAVIGATION TOOLS FOR FORMS

    Specifically works with:
        Tool Bars
        Save, Edit, Deleting

*/
//NAVIGATION //////////////////////////////////

// Nav Variables //

function ToolBar(barId,butId,toolId,acts){
    this.bar = document.getElementById(barId);
    this.button = document.getElementById(butId);
    this.tools = document.getElementById(toolId);
    this.buttHeight = this.button.style.height;
    this.actions = acts;
}; //Holds Bid_Tool_Bar

///////////////////


// PUBLIC VARIABLES //

var TB; //ToolBar Object


// EVENTS //
function SideToolSwitch(){
    if(TB.tools.style.display == 'none'){
        TB.tools.style.display = 'block';
        TB.button.innerText = '>';
    }else{
        TB.tools.style.display = 'none';
        TB.button.innerText = '<';
    };
}


//Sets the DOM elements that are related Tools and navigation in a form
function SetDomNav(){
    //Tool bar
    TB = new ToolBar('Bid_Tool_Bar','Bid_Tool_Button','Bid_Tools');
}

function SetNavEvents(){
    TB.button.addEventListener('click',SideToolSwitch);   
}

function NavSetup(){
    SetDomNav();
    SetNavEvents();
}

