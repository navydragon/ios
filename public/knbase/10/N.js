const fs = require('fs');
let fileContent = fs.readFileSync("input.txt", "utf8").toString().split(/\n/);
fileContent = fileContent.map(function(row) { return row.replace(/\r/,'')});

let s = fileContent[0];
let arr = [];
let center_flag = 0;
let result = 0;
for (let i = 0; i<s.length; i++)
{
    let pos = s.charCodeAt(i);
    arr[pos] = arr[pos]+1 || 1;
    if (arr[pos] == 1) {center_flag++ }
    if (arr[pos] == 2) 
    {
        center_flag--
        result+=2
        arr[pos]=0
    }
}
if (center_flag > 0) result++
console.log(result);