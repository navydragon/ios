function hash(a,m,s)
{
    let hash = 0;
    for (let i = 0; i < s.length; i++) {
        hash = hash * a + s.charCodeAt(i);
        hash %= m; 
    }
    return hash;
}


const fs = require('fs');
let fileContent = fs.readFileSync("input.txt", "utf8").toString().split(/\n/);
fileContent = fileContent.map(function(row) { return row.replace(/\r/,'')});

let a = parseInt(fileContent[0]);
let m = parseInt(fileContent[1]);
let s = fileContent[2];

console.log(hash(a,m,s));