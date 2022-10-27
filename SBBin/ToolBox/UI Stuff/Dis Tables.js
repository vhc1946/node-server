/*            GENERAL TABLE FOR DISPLAY

    Sections are defined in the DOM as:
        <div> //container
            <div> //row or header
                <div> cost title </div>
                <div> data 1 </div>
                <div> <input> data 2 </input></div> // input,select,.. are wrapped in <div>
            </div>
        </div>
*/
class GenUITable{
    constructor(tabId){
        this.body = document.getElementById(tabId);
        this.header = this.body.children[0];

        // can reach table ID through this.body.id
    }
    
    /*  Returns an element from an input section row.
        Pass: r (desired row)
              c (desired column)
        If child has children, then searchs until there are no parents
        <div><input><input><div> - returns <input>
    */
    GetEle(r,c){
        var it = this.body.children[r].children[c];
        if(it.childElementCount>0){
            it = it.children[0];
        }
        return it; 
    }
    /*  Returns the Value (STRING) from an element in an input section row
        Pass: r (desired row)      
              c (desired column)
    */
    GetValue(r,c){
        var val = this.body.children[r].children[c];
        if(val.childElementCount>0){
            return val.children[0].value;
        }
        return val.innerText;
    }
    //  Returns an entire input sectoin row as a an array of values (STRINGs)
    //  Pass: r(desired row)
    GetRowData(r){
        let ta=[];
        for(var x=0;x<this.body.children[r].childElementCount;x++){
            ta.push(this.GetValue(r,x));
        }
        return ta;
    }
    //  Returns the row number matching that of a passed element
    //  Pass: ele(element to search with)
    GetRow(ele){
        let i = 1;
        while(ele!=ele.parentNode.children[i] && ele.parentNode.children[i] ) i++;
        return i;
    }
    /*  Returns the sections as a 2 demensional array
        ARRAY STRUCTURE:
        ROW 1 - [dom_idname (aligns with the bid cost given name)], [header names]
    */
    GetSectionData(){
        let sa = [];
        sa.push(this.GetRow(0)); //pulls the header from section
        sa[0][0]=this.body.id; //Get the section ID name as [0]

        for(var x=1;x<this.body.childElementCount;x++){
            sa.push(this.GetRow(x));
        }
        return sa; //Return data as array[][].
    }
}
