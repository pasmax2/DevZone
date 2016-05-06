gDataOrig = 'https://www.ts-x.eu/api';
// gDataOrig = 'http://127.0.0.1:8090';

shortenString = function (str, len){
  if(str.length <= len){
    return str;
  }
  var out = str.substring(0,len);
  console.log(out);
  out = out.split(' ');
  out.length--;
  return out.join(' ')+'...';
};

require('./apps.js');