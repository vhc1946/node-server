/*
    Performance Verification
    Goal:
        Describe the results of consultant recomendations to the customer by showing a list of options that
        get get better as they go.

    This page loads from a created bid and a list of customer asked questions.

    CREATED BID:
        A bid is described as an object of 4 options to show the customer.
        Part of the Bid object is passed through a .json file created in the RR Bid Form.

        Equipment:
            - Warranties
            - Efficiencies
            - Comfort
            - Information

        Customer:
            Answers for scales

*/
const bid = require('JS/RR_Bids.js');

class PerfVerif extends Bid{
    /*
    Interface to display the Performance Verification portion of
     the Bid.

     PASS:
        - cust - object
    */
   constructor(cust,sys,q){
       super(cust,sys);

       this.qa=q;

   }

   loadPF(){

   }

}