
const fs = require('fs');
let fileContent = fs.readFileSync("input.txt", "utf8").toString().split(/\n/);
fileContent = fileContent.map(function(row) { return row.replace(/\r/,'')});

let k_l = parseInt(fileContent[0]);
let keys = fileContent[1].split(" ");
let v_l = parseInt(fileContent[2]);
let vals = fileContent[3].split(" ");

for (i = 0; i < k_l; i++)
{
    if (i >= v_l) {p_v = "None";}else{p_v=vals[i];}
    console.log(keys[i]+": "+p_v)
}