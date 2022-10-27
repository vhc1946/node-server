/* THIS FILE CAN ACT AS THE STARTING POINT OF THE BID FORM TEMPLATE
    
    -FIRST AN OBJECT NEEDS TO BE ABLE TO BE CREATED FROM THE TEMPLATE
      AND SAVED FOR REFERENCE LATER
    -IN THE BID COST SECTIONS, LINES NEED TO BE ABLE TO BE ADDED AS
      WELL AS TAKEN AWAY. WHEN THE OBJECT IS SAVED, WHEN REFERED TO
      LATER THE LINES NEED TO MATCH THAT OF WHEN IT WAS SAVED, DESPITE
      WHAT THE DEFAULT IS.
    -CREATE A WAY FOR USERS TO SAVE BIDS AS A DEFAULT TEMPLATE TO SAVE
      FUTURE WORK.
*/



/*Function to run for bid setup
    Creating for 200 to start, want to use in 450 bids also
*/

//INFORMATION SECTION /////////////////////////

class Bid{
    constructor(binfo){
        if(binfo){ //fills from a passed bid object
            this.id= binfo.id || "";
            this.name= binfo.name || "";
            this.address= binfo.address || {
                street: "",
                unit: "",
                city: "",
                state: "",
                zip: ""
            };
            this.contact = binfo.contact || {
                name: "",
                phone: "",
                phone2: "",
                email: "",
                email2: ""
            };
            this.estimator = binfo.estimator || "";
            this.costObjs = binfo.costObjs || []; //Array of the displayed cost sections objects
            this.dates = binfo.dates || {
                start:"",
                due:"",
                recieved:"",
                revised:""
            };
        }else{ //creates an empty bid object
            this.id= "";
            this.name="";
            this.address = {
                street: "",
                unit: "",
                city: "",
                state: "",
                zip: ""
            };
            this.contact = {
                name: "",
                phone: "",
                phone2: "",
                email: "",
                email2: ""
            };
            this.estimator="";
            this.costObjs = []; //Array of the displayed cost sections objects
            this.dates = {
                start:"",
                due:"",
                recieved:"",
                revised:""
            };
        }
    //his.cust = custInfo; //Customer Object
    }
}
///////////////////////////////////////////////


//COSTING SECTIONS ////////////////////////////

class SummarySection{

}

/*  COST SECTION
    The CostSection Class acts as the interace to the UI.
     It is extended by each specific cost section.

     ** 
        Generic parts of this class have been moved to a class
        handling data in an HTML table structure in the DOM
     **
*/
class CostSection{
    constructor(inputId,sumryId,marginId){
        this.ISec = document.getElementById(inputId); //Cost Input Section (For a specific type of cost)
        this.Iheader = this.ISec.children[0]; //Input Header (First row of Input Section)


        // Create a Summary object to map the cost too
        this.SSec = document.getElementById(sumryId); //Cost Summary Section (For a specific type of cost)

        this.margn = document.querySelector('[name=' + marginId + ']');
        this.totalSum = this.SSec.querySelector('[name="sumTotal"]'); //Sum Total of section, after tax/margin applied
        this.totalCost = this.SSec.querySelector('[name="totalCost"]') //Sum Cost Total of section
        this.totalProfit = this.SSec.querySelector('[name="totalProfit"]'); //Profit Total dependant on margin
    }

    /*                      GETTERS                     */
    

    //Returns an element from an input section row.
    //Pass: r (desired row)
    //      c (desired column)
    //If child has children, then searchs until there are no parents
    //  <div><input><input><div> - returns <input>
    GetEle(r,c){
        var it = this.ISec.children[r].children[c];
        if(it.childElementCount>0){
            it = it.children[0];
        }
        return it; 
    }
    //Returns the Value (STRING) from an element in an input section row
    //Pass: r (desired row)
    //      c (desired column)
    //
    GetValue(r,c){
        var val = this.ISec.children[r].children[c];
        if(val.childElementCount>0){
            return val.children[0].value;
        }
        return val.innerText;
    }
    //Returns an entire input sectoin row as a an array of values (STRINGs)
    //Pass: r(desired row)
    GetRowData(r){
        let ta=[];
        for(var x=0;x<this.ISec.children[r].childElementCount;x++){
            ta.push(this.GetValue(r,x));
        }
        return ta;
    }
    //Returns the row number matching that of a passed element
    //Pass: ele(element to search with)
    GetRow(ele){
        let i = 1;
        while(ele!=ele.parentNode.children[i] && ele.parentNode.children[i] ) i++;
        return i;
    }
    //Returns (STRING) the Total Sum of the set summary section
    GetSumTotal(){
        return this.totalSum.innerText;
    }
    //Returns (STRING) the Total Sum Cost of the set summary section
    GetSumCost(){
        return this.totalCost.innerText;
    }
    //Returns (STRING) the Total Sum of the set summary section
    GetProfitTotal(){
        return this.totalProfit.innerText;
    }

    //Returns the sections as a 2 demensional array
    // ARRAY STRUCTURE:
    //  ROW 1 - [dom_idname (aligns with the bid cost given name)], [header names]
    GetSectionData(){
        let sa = [];
        sa.push(this.GetRow(0)); //pulls the header from section
        sa[0][0]=this.ISec.id; //Get the section ID name as [0]

        for(var x=1;x<this.ISec.childElementCount;x++){
            sa.push(this.GetRow(x));
        }
        return sa; //Return data as array[][].
    }
    // GET END /////////////////////////////////////////////



    /*                      SETTERS                     */
    /*
        Setters handle the derivation of the value and
         place the found value in the correct element.
        The only setters with an included formula are ones
         where the sections all share the same formulas.
        
        Because the setters are placing the value in the
         DOM, some thoughs need to be put into formating
         the values (most values are $$).

    *////////////////////////////////////////////////////////////

    //Sets the Sum total of in a section's summary row element
    //Need to deal with bad numbers in summary section
    //Resulting value is a number and may need formating to UI
    SetSumTotal(){
        let tc = Number(this.totalCost.innerText);
        let tp = Number(this.totalProfit.innerText);
        this.totalSum.innerText = (tc + tp).toFixed(2);
    }
    //Sets the Sum total from the input section
    //Pass: val (sum value from input section)
    //Value is a number and may need formating
    SetSumCost(val){
        this.totalCost.innerText = (val).toFixed(2);
    }
    //Sets the Sum total of in a section's summary row element
    //Pass: marg (desired margin !AS DECIMAL PERCENT!)
    SetProfitTotal(){
        var marg = Number(this.margn.value);
        let tc = Number(this.totalCost.innerText);
        this.totalProfit.innerText = (tc/(1-marg)-tc).toFixed(2);
    }
    // SET END /////////////////////////////////////////////


    //Returns the sum of a column in the input section.
    //Pass: c (desired column)
    SectionTotaler(c){
        var toter = 0;
        for(var r=1;r<this.ISec.childElementCount;r++){
            toter = toter + Number(this.GetValue(r,c));
        }
        return toter;
    }
};

//Material cost is found in the Labor Input Section.
// For costId = "labor section name"
class MatSection extends CostSection{
    constructor(costId,sumId,marginId){
        super(costId,sumId,marginId);

        this.matMarg = document.querySelector('[name=' + marginId + ']'); //the Material margin
    }
    costChanger = (event)=>{
        this.updateSummary();
    }
    updateSummary = ()=>{
        this.SetSumCost(this.SectionTotaler(4));
        this.SetProfitTotal();
        this.SetSumTotal();
    }
};
class LabSection extends CostSection{
    constructor(costId,sumId,marginId,rateTabName,rateTab){
        super(costId,sumId,marginId);
        this.rates={};
        this.rates.sec = document.getElementById(rateTabName);
        this.rates.listName = "LabRateList";
        this.rates.tab =  rateTab || null;

        if(this.rates.tab !=null){ //if the labor rate tables are passed set display to passed table
            
        }else{ //if labor rate table is not passed, initialize table to display values
            this.SetLabTable();
        }

        this.SetLabRateList();
    }

    costChanger=(event)=>{//describes any auto calculations in the Labor Section
        var ect = event.currentTarget;
        var erow = this.GetIndex(ect); //Get the row where the event happened

        //update row calculations
        ect.children[3].innerText = this.GetValue(erow,1) * this.GetValue(erow,2); //calc hours
        ect.children[5].innerText = this.GetValue(erow,3) * this.GetLabRate(this.GetValue(erow,6)); //calc of labor cost, need reference to labor rates

        //Adjust Labor Summary
        this.updateSummary();
        
    };
    updateSummary =()=>{
        this.SetSumCost(this.SectionTotaler(5)); //Adjust labor cost total
        this.SetProfitTotal();
        this.SetSumTotal();

    };
    updateLabRates = ()=>{
        this.SetLabRateList();
        //loop through all the rows in the labor section and adjust the values dependent on labor rates
        for(var x=1;x<this.ISec.childElementCount;x++){
            this.ISec.children[x].children[5].innerText = this.GetValue(x,3) * this.GetLabRate(this.GetValue(x,6)); 
        }
    };

    GetLabRate(lr){ //gets the labor rate value with the labor rate id from the labor rate table 
        for(var x=0;x<this.rates.tab.length;x++){
            if(this.rates.tab[x][0]==lr){
                return Number(this.rates.tab[x][1]);
            }
        }
        return 0;
    }
    SetLabRateList(){
        this.SetLabTable();
        var lrL = document.querySelectorAll('[name=' + this.rates.listName + ']');
        console.log(this.rates.tab[0].length);
        for(var x=0;x<lrL.length;x++){
            for(var y=0;y<this.rates.tab.length;y++){
                lrL[x].appendChild(document.createElement("option"));
                lrL[x].children[y].innerText = this.rates.tab[y][0];
            }
        }
    }
    //Sets the Labor Rate table for internal use to reflect the values in the side toolbar
    SetLabTable(){
        let lra=[];
        for(var x=0;x<this.rates.sec.childElementCount;x++){
            let lrr = [];
            lrr.push(this.rates.sec.children[x].children[1].name);
            lrr.push(Number(this.rates.sec.children[x].children[1].value));

            lra.push(lrr);
        }
        this.rates.tab = lra;
    }
    //Loads the 
    LoadLabTableDisplay(rtab){

    }
}
class EquipSection extends CostSection{
    constructor(costid,sumId,marginId){
        super(costid,sumId,marginId);
    }

    costChanger = (event)=>{
        var ect = event.currentTarget;
        var erow = this.GetIndex(ect);

        ect.children[4].innerText = this.GetValue(erow,2) * this.GetValue(erow,3);

        //Adjust Equipment Summary
        this.updateSummary();

    };
    updateSummary =()=>{
        this.SetSumCost(this.SectionTotaler(4));
        this.SetProfitTotal();
        this.SetSumTotal();
    };
}
class SubSection extends CostSection{
    constructor(costId,sumId,marginId){
        super(costId,sumId,marginId);
    }

    costChanger =(event)=>{
        //Adjust Subcontractor Summary
        this.updateSummary();
    };
    updateSummary =()=>{//updates the summary section for subcontractors
        this.SetSumCost(this.SectionTotaler(2));
        this.SetProfitTotal();
        this.SetSumTotal();
    };
}
////////////////////////////////////////////



//FORM VARIABLES ///////////////////////////
var TB;
var LS; //Labor Section Object
var MS; //Material Section Object
var ES; //Equipment Section Object
var SS; //Subcontractor Section Object

var B; //Bid class

actionbuttons = {
    submit:()=>{return document.getElementById("Bid_Form_Submit")},
    save:()=>{return document.getElementById("Bid_Form_Save")},
    print:()=>{return document.getElementById("Bid_Form_Print")}
};
////////////////////////////////////////////


SetDom=()=>{
    //Tool bar
    TB = new ToolBar('Bid_Tool_Bar','Bid_Tool_Button','Bid_Tools',actionbuttons);
    //Cost Objects
    LS = new LabSection('Bid_Labor_Cost_Section','Bid_Labor_Sumry','LaborMargin','Bid_LaborRateTable',[3,3]);
    MS = new MatSection('Bid_Labor_Cost_Section','Bid_Material_Sumry','MaterialMargin');
    ES = new EquipSection('Bid_Equipment_Cost_Section','Bid_Equip_Sumry','EquipmentMargin');
    SS = new SubSection('Bid_Sub_Cost_Section','Bid_Sub_Sumry','SubcontractMargin');

    //Add the objects created above to the Bid object, exluded MS because it is in the same section as 
    
    //B = new Bid([LS,ES,SS]);
}

/*  The entire section gets an 'change' event. every change event triggers a 

    list of calculations on particular columns of data.
    Each row of the section will have their own event handler, limiting the
    unneeded calculations to whole section.

*/
SetBidFormEvents=()=>{//here set all the events handling auto calculations
    var tempSec; //temporary section object used
    var tempEve; //temporary section event used

    for(x=1;x<=4;x++){ //set the events for the cost section

        //insert switch case to change the section
        //add more sections with similar event structure
        switch(x){
            case 1: 
                tempSec = LS.ISec;
                tempEve = LS.costChanger;
                break;
            case 2: 
                tempSec = ES.ISec;
                tempEve = ES.costChanger;
                break;
            case 3:
                tempSec = SS.ISec;
                tempEve = SS.costChanger;
                break;
            case 4:
                tempSec = MS.ISec;
                tempEve = MS.costChanger;

        }
        for(y=1;y<tempSec.childElementCount;y++){
            tempSec.children[y].addEventListener('change',tempEve); //set an eventlistener for each row of each section
        }
    }



    // Tool Bar Section //

    //Lab Rate Tables
    LS.rates.sec.addEventListener('change',LS.updateLabRates);
    //set the events for margin changes

    //Labor and Material Margins
    LS.margn.addEventListener('change',LS.updateSummary);
    ES.margn.addEventListener('change',ES.updateSummary);
    SS.margn.addEventListener('change',SS.updateSummary);
    MS.margn.addEventListener('change',MS.updateSummary);


    //set the events for labor rate changes


    //set nav actions
    //TB.actions.submit().addEventListener('click',B.SubmitForm);
}

BidSetup=(Bdat)=>{

    if(Bdat==null){/*NO Bid data was passed, from scratch (Default) bid situation */

        //setup the DOM
        //console.log(LabCostSec.children[1].children[0].innerText); // REFERENCE TO THE TITLE OF THE FIRST ROW OF LABOR SECTION DATA
        SetDom();
        SetBidFormEvents();
    }
}

