function g(){throw"TheLanguage PANIC";}var q=[];function u(a){a in aa||g();return[q,0,aa[a]]}exports.new_symbol=u;function v(a){return 0===a[1]}exports.symbol_p=v;function ba(a){return da[a[2]]}exports.un_symbol=ba;function w(a,b){return[q,1,a,b]}exports.new_construction=w;function x(a){return 1===a[1]}exports.construction_p=x;function ea(a){return a[2]}exports.construction_head=ea;function fa(a){return a[3]}exports.construction_tail=fa;var z=[q,2];exports.null_v=z;function A(a){return 2===a[1]}
exports.null_p=A;function B(a,b){return[q,3,a,b]}exports.new_data=B;function D(a){return 3===a[1]}exports.data_p=D;function ha(a){return a[2]}exports.data_name=ha;function ia(a){return a[3]}exports.data_list=ia;function ja(a,b){return[q,4,a,b]}exports.new_error=ja;function E(a){return 4===a[1]}exports.error_p=E;function ka(a){return a[2]}exports.error_name=ka;function la(a){return a[3]}exports.error_list=la;function ma(a,b){return[q,6,a,b]}exports.evaluate=ma;function F(a,b){return[q,7,a,b]}
function na(a,b){return[q,9,a,b]}exports.apply=na;function oa(a){a=G(a);if(D(a)||E(a)||x(a)){var b=a[3];a[2]=oa(a[2]);a[3]=oa(b)}return a}exports.force_all_rec=oa;function I(a,b){a!==b&&(a[0]=q,a[1]=5,a[2]=b,a[3]=!1,a[4]=!1)}function pa(a,b){10===a[0]||g();a[0]=b[0];a[1]=b[1];a[2]=b[2];a[3]=b[3];a[4]=b[4]}
var aa={0:"0",1:"1",2:"2",3:"3",4:"4",5:"5",6:"6",7:"7",8:"8",9:"9",A:"A",B:"B",C:"C",D:"D",E:"E",F:"F",G:"G",H:"H",I:"I",J:"J",K:"K",L:"L",M:"M",N:"N",O:"O",P:"P",Q:"Q",R:"R",S:"S",T:"T",U:"U",V:"V",W:"W",X:"X",Y:"Y",Z:"Z",a:"a",b:"b",c:"c",d:"d",e:"e",f:"f",g:"g",h:"h",i:"i",j:"j",k:"k",l:"l",m:"m",n:"n",o:"o",p:"p",q:"q",r:"r",s:"s",t:"t",u:"u",v:"v",w:"w",x:"x",y:"y",z:"z","\u4e00\u985e\u4f55\u7269":"\u3749","\u4e4b\u7269":"\ud86d\ude66","\u5176\u5b50":"\ud85a\udfaa","\u51fa\u5165\u6539\u6ec5":"\ud849\udc9f",
"\u5217\u5e8f":"\ud841\udf3a","\u5316\u6ec5":"\ud840\udfc1","\u53c3\u5f62":"\ud842\udef0","\u543e\u81ea":"\ud85a\udcf9","\u592a\u59cb\u521d\u6838":"\ud84d\udf57","\u5982\u82e5":"\ud85b\udc61","\u5b87\u5b99\u4ea1\u77e3":"\ud863\ude79","\u5c3e\u672b":"\ud847\udcb5","\u5e8f\u4e01":"\ud840\udda4","\u5e8f\u4e19":"\ud840\uddee","\u5e8f\u4e59":"\u3408","\u5e8f\u7532":"\ud840\uddda","\u5f0f\u5f62":"\u4f71","\u5f15\u7528":"\u39c8","\u61c9\u7528":"\ud853\udc06","\u6548\u61c9":"\u52b9","\u6620\u8868":"\ud850\udd54",
"\u662f\u975e":"\u6b24","\u69cb\u7269":"\ud845\udcab","\u70ba\u7b26\u540d\u9023":"\u2010","\u7279\u5b9a\u5176\u7269":"\u4e93","\u7701\u7565\u4e00\u7269":"\u7567","\u7b26\u540d":"\u8b3c","\u7b49\u540c":"\u5f0c","\u89e3\u7b97":"\u7b6d","\u8a3b\u758f":"\u758e","\u8a5e\u7d20":"\ud85e\udd5d","\u8b2c\u8aa4":"\u4958","\u9023\u9838":"\u4e29","\u9593\u7a7a":"\ud84e\udcd3","\u9670":"\u4f8c","\u967d":"\ud84c\udd84","\u9996\u59cb":"\ud866\udc10"},da={0:"0",1:"1",2:"2",3:"3",4:"4",5:"5",6:"6",7:"7",8:"8",9:"9",
A:"A",B:"B",C:"C",D:"D",E:"E",F:"F",G:"G",H:"H",I:"I",J:"J",K:"K",L:"L",M:"M",N:"N",O:"O",P:"P",Q:"Q",R:"R",S:"S",T:"T",U:"U",V:"V",W:"W",X:"X",Y:"Y",Z:"Z",a:"a",b:"b",c:"c",d:"d",e:"e",f:"f",g:"g",h:"h",i:"i",j:"j",k:"k",l:"l",m:"m",n:"n",o:"o",p:"p",q:"q",r:"r",s:"s",t:"t",u:"u",v:"v",w:"w",x:"x",y:"y",z:"z","\u3749":"\u4e00\u985e\u4f55\u7269","\ud86d\ude66":"\u4e4b\u7269","\ud85a\udfaa":"\u5176\u5b50","\ud849\udc9f":"\u51fa\u5165\u6539\u6ec5","\ud841\udf3a":"\u5217\u5e8f","\ud840\udfc1":"\u5316\u6ec5",
"\ud842\udef0":"\u53c3\u5f62","\ud85a\udcf9":"\u543e\u81ea","\ud84d\udf57":"\u592a\u59cb\u521d\u6838","\ud85b\udc61":"\u5982\u82e5","\ud863\ude79":"\u5b87\u5b99\u4ea1\u77e3","\ud847\udcb5":"\u5c3e\u672b","\ud840\udda4":"\u5e8f\u4e01","\ud840\uddee":"\u5e8f\u4e19","\u3408":"\u5e8f\u4e59","\ud840\uddda":"\u5e8f\u7532","\u4f71":"\u5f0f\u5f62","\u39c8":"\u5f15\u7528","\ud853\udc06":"\u61c9\u7528","\u52b9":"\u6548\u61c9","\ud850\udd54":"\u6620\u8868","\u6b24":"\u662f\u975e","\ud845\udcab":"\u69cb\u7269",
"\u2010":"\u70ba\u7b26\u540d\u9023","\u4e93":"\u7279\u5b9a\u5176\u7269","\u7567":"\u7701\u7565\u4e00\u7269","\u8b3c":"\u7b26\u540d","\u5f0c":"\u7b49\u540c","\u7b6d":"\u89e3\u7b97","\u758e":"\u8a3b\u758f","\ud85e\udd5d":"\u8a5e\u7d20","\u4958":"\u8b2c\u8aa4","\u4e29":"\u9023\u9838","\ud84e\udcd3":"\u9593\u7a7a","\u4f8c":"\u9670","\ud84c\udd84":"\u967d","\ud866\udc10":"\u9996\u59cb"},K=u("\u592a\u59cb\u521d\u6838"),qa=u("\u7b26\u540d"),M=u("\u5316\u6ec5"),N=u("\u5f0f\u5f62"),ra=u("\u7b49\u540c"),sa=
u("\u89e3\u7b97"),ta=u("\u7279\u5b9a\u5176\u7269"),O=u("\u7701\u7565\u4e00\u7269"),ua=u("\u6620\u8868"),va=u("\u5982\u82e5"),P=u("\u4e00\u985e\u4f55\u7269"),wa=u("\u662f\u975e"),xa=u("\u5176\u5b50"),ya=u("\u967d"),za=u("\u9670"),Aa=u("\u5f15\u7528"),Ba=u("\u61c9\u7528"),Ea=u("\u9593\u7a7a"),Fa=u("\u9023\u9838"),Ga=u("\u69cb\u7269"),Ha=u("\u8b2c\u8aa4"),Ia=u("\u8a5e\u7d20"),Ja=u("\u5217\u5e8f"),Ka=u("\u9996\u59cb"),La=u("\u5c3e\u672b"),Ma=u("\u4e4b\u7269"),Na=u("\u5b87\u5b99\u4ea1\u77e3"),Oa=u("\u8a3b\u758f"),
Pa=ja(K,R(Na,O));function S(a){return B(qa,R(K,a))}function Qa(a){return S(R(P,R(M,O,a),ta))}function Ra(a,b){return S(R(P,R(M,R(a),O),b))}function Sa(a){return S(R(P,M,R(wa,R(P,a,O))))}
var Ta=Qa(Ga),$a=Ra(Ga,qa),ab=Ra(Ga,Ja),bb=Sa(Ga),cb=Qa(Ha),db=Ra(Ha,qa),eb=Ra(Ha,Ja),fb=Sa(Ha),gb=Qa(Fa),hb=Sa(Fa),ib=Ra(Fa,Ka),jb=Ra(Fa,La),kb=Sa(Ia),lb=Sa(Ea),mb=S(R(P,M,R(wa,ra))),nb=S(R(P,R(M,w(M,O),O),Ba)),ob=S(R(P,M,sa)),pb=Ra(Ja,R(P,Ma,O)),qb=S(R(P,M,va)),rb=S(R(P,N,Aa)),sb=S(R(P,R(N,R(M,O,M)),ta)),tb=S(R(N,R(K,M))),ub=S(R(N,R(K,N))),wb=S(R(N,N)),xb=S(R(P,M,Oa)),yb=S(R(P,N,Oa)),zb=B(za,R()),Ab=B(ya,R());function Bb(a,b){return a===b?!0:a[2]===b[2]?(I(a,b),!0):!1}
function T(a){for(var b=z,c=a.length-1;0<=c;c--)b=w(a[c],b);return b}exports.jsArray_to_list=T;function Cb(a,b,c){for(var d=[];x(a);)d.push(a[2]),a=a[3];return A(a)?b(d):c(d,a)}function Db(a){return Cb(a,function(b){return b},function(){return!1})}exports.maybe_list_to_jsArray=Db;function R(){for(var a=[],b=0;b<arguments.length;b++)a[b]=arguments[b];return T(a)}exports.new_list=R;function Eb(a){for(var b=[];5===a[1];)b.push(a),a=a[2];for(var c=0;c<b.length;c++)I(b[c],a);return a}
function U(a){return 5===a[1]||6===a[1]||8===a[1]||7===a[1]||9===a[1]}exports.delay_p=U;
function G(a,b,c,d){function e(H){I(p,H);for(var L=0;L<d.length;L++)I(d[L],H);return H}function l(){c[1]=!0;return m(Pa)}function m(H){e(H);return U(H)?(d.push(p),G(H,b,[!1,!1],d)):H}function k(){var H={},L;for(L in n)H[L]=!0;for(L in b)H[L]=!0;return H}void 0===b&&(b={});void 0===c&&(c=[!1,!1]);void 0===d&&(d=[]);var n={},p=a;for(a=0;U(p)&&32>a;a++)d.push(p),p=V(p);for(;U(p);){a=W(p);if(!0===b[a])return l();if(!0===n[a]){c[0]=!0;if(6===p[1])return l();if(7===p[1]){a=p[2];for(var C=p[3],Q=!1,J=0,
ca=[$a,ab,bb,db,eb,fb,hb,ib,jb,kb,lb];J<ca.length;J++)if(X(ca[J],a)){Q=!0;break}if(Q)return 1===C.length||g(),!1===c[1]||g(),C=G(C[0],k(),c),c[1]?m(F(a,[C])):g();if(X(a,mb)||X(a,nb)||X(a,ob))return l();if(X(a,qb)&&(3===C.length||g(),!1===c[1]||g(),a=G(C[0],k(),c),c[1]))return m(F(qb,[a,C[1],C[2]]))}else if(8===p[1]||9===p[1])return l();return g()}n[a]=!0;d.push(p);p=V(p)}return e(p)}exports.force_all=G;
function V(a){var b=Eb(a);5!==b[1]||g();if(6===b[1])a=Fb(b[2],b[3],a);else if(8===b[1])a:{a=b[2];var c=b[3],d=b[4],e=ja(K,R(ub,R(Gb(a),c,T(d))));if(X(c,rb))a=1!==d.length?e:d[0];else if(X(c,sb))a=2!==d.length?e:Hb(a,d[0],d[1],e);else{if(X(c,yb)){if(2!==d.length){a=e;break a}throw"WIP";}a=e}}else if(7===b[1])a:{e=b[2];a=b[3];c=ja(K,R(tb,R(e,T(a))));for(d=0;d<Ib.length;d++)if(X(e,Ib[d][0])){e=Ib[d][1];if(a.length!==e)break;d=Ib[d][2];a=1===e?d(a[0],c):2===e?d(a[0],a[1],c):3===e?d(a[0],a[1],a[2],c):
g();break a}a=c}else a=9===b[1]?Jb(b[2],b[3],a):b;a=Eb(a);I(b,a);return a}exports.force1=V;var Kb=[];exports.env_null_v=Kb;function Lb(a,b,c){for(var d=[],e=0;e<a.length;e+=2){if(X(a[e+0],b)){d[e+0]=b;d[e+1]=c;for(e+=2;e<a.length;e+=2)d[e+0]=a[e+0],d[e+1]=a[e+1];return d}d[e+0]=a[e+0];d[e+1]=a[e+1]}d[a.length+0]=b;d[a.length+1]=c;return d}exports.env_set=Lb;function Mb(a,b,c){for(var d=0;d<a.length;d+=2)if(X(a[d+0],b))return a[d+1];return c}exports.env_get=Mb;
function Nb(a,b){for(var c=0;c<a.length;c+=2)if(X(a[c+0],b))return a[c+1];return g()}function Gb(a){for(var b=z,c=0;c<a.length;c+=2)b=w(R(a[c+0],a[c+1]),b);return B(ua,R(b))}exports.env2val=Gb;function Ob(a,b){for(var c=0;c<a.length;c+=2)b(a[c+0],a[c+1])}exports.env_foreach=Ob;
function Pb(a){a=G(a);if(!D(a))return!1;var b=G(a[2]);if(!v(b)||!Bb(b,ua))return!1;b=G(a[3]);if(!x(b)||!A(G(b[3])))return!1;a=[];for(b=G(b[2]);!A(b);){if(!x(b))return!1;var c=G(b[2]);b=G(b[3]);if(!x(c))return!1;var d=c[2];c=G(c[3]);if(!x(c))return!1;var e=c[2];if(!A(G(c[3])))return!1;c=!0;for(var l=0;l<a.length;l+=2)if(X(a[l+0],d)){a[l+1]=e;c=!1;break}c&&(a.push(d),a.push(e))}return a}exports.val2env=Pb;
function Fb(a,b,c){var d=V(b);if(U(d))return c;var e=ja(K,R(tb,R(ob,R(Gb(a),d))));if(x(d)){for(b=[];!A(d);){if(U(d))return c;if(x(d))b.push(d[2]),d=V(d[3]);else return e}if(X(b[0],ub)){if(1===b.length)return e;d=b[1];c=[];for(e=2;e<b.length;e++)c.push(b[e]);return[q,8,a,d,c]}if(X(b[0],wb)){if(1===b.length)return e;d=G(ma(a,b[1]));if(!D(d))return e;var l=V(d[2]);if(U(l))return c;if(!v(l)||!Bb(l,N))return e;l=V(d[3]);if(U(l))return c;if(!x(l))return e;d=l[2];l=V(l[3]);if(U(l))return c;if(!A(l))return e;
c=[Gb(a)];for(e=2;e<b.length;e++)c.push(b[e]);return na(d,c)}if(X(b[0],tb)){if(1===b.length)return e;d=b[1];c=[];for(e=2;e<b.length;e++)c.push(ma(a,b[e]));return F(d,c)}d=ma(a,b[0]);c=[];for(e=1;e<b.length;e++)c.push(ma(a,b[e]));return na(d,c)}return A(d)?d:v(d)||D(d)?Mb(a,d,e):E(d)?e:g()}function Qb(a,b){return[a,1,function(c){c=V(c);return U(c)?F(a,[c]):b(c)?Ab:zb}]}function Rb(a,b,c){return[a,1,function(d,e){d=V(d);return U(d)?F(a,[d]):b(d)?c(d):e}]}
var Ib=[Qb(bb,D),[Ta,2,B],Rb($a,D,ha),Rb(ab,D,ia),Qb(fb,E),[cb,2,ja],Rb(db,E,ka),Rb(eb,E,la),Qb(lb,A),[gb,2,w],Qb(hb,x),Rb(ib,x,ea),Rb(jb,x,fa),[mb,2,function(a,b){function c(d,e,l,m){l=F(mb,[l(d),l(e)]);d=F(mb,[m(d),m(e)]);return F(qb,[l,d,zb])}if(a===b)return Ab;a=V(a);b=V(b);if(U(a)||U(b))return F(mb,[a,b]);if(a===b)return Ab;!U(a)||g();return A(a)?A(a)?Ab:zb:v(a)?v(b)?Bb(a,b)?Ab:zb:zb:D(a)?D(b)?c(a,b,ha,ia):zb:x(a)?x(b)?c(a,b,ea,fa):zb:E(a)?E(b)?c(a,b,ka,la):zb:g()}],[nb,2,function(a,b,c){var d=
[];for(b=G(b);x(b);)d.push(b[2]),b=G(b[3]);return A(b)?na(a,d):c}],[ob,2,function(a,b,c){a=Pb(a);return!1===a?c:ma(a,b)}],Qb(kb,v),[pb,1,function(a,b){a=V(a);return U(a)?F(pb,[a]):x(a)?a[2]:b}],[qb,3,function(a,b,c,d){a=V(a);if(U(a))return F(qb,[a,b,c]);if(!D(a))return d;a=G(a[2]);return v(a)?Bb(a,ya)?b:Bb(a,za)?c:d:d}],[xb,2,function(){throw"WIP";}]];
function Jb(a,b,c){function d(){return ja(K,R(tb,R(nb,R(a,T(b)))))}a=V(a);if(U(a))return c;if(!D(a))return d();c=G(a[2]);if(!v(c)||!Bb(c,M))return d();var e=G(a[3]);if(!x(e))return d();c=oa(e[2]);e=G(e[3]);if(!x(e)||!A(G(e[3])))return d();e=e[2];for(var l=Kb,m=0;!A(c);)if(v(c)||D(c)){for(var k=z,n=b.length-1;n>=m;n--)k=w(b[n],k);l=Lb(l,c,k);m=b.length;c=z}else if(x(c))if(m<b.length)k=b[m],m++,l=Lb(l,c[2],k),c=c[3];else return d();else return d();return b.length!==m?d():ma(l,e)}
function Hb(a,b,c,d){void 0===d&&(d=!1);b=oa(b);for(var e=[],l=!1,m=b;!A(m);)if(v(m)||D(m))e.push(m),l=!0,m=z;else if(x(m))e.push(m[2]),m=m[3];else return!1===d?ja(K,R(ub,R(Gb(a),sb,T([b,c])))):d;d=b;l&&(d=T(e));var k=[];Ob(a,function(n){for(var p=0;p<e.length;p++)if(X(e[p],n))return;k.push(n)});l=d;for(m=k.length-1;0<=m;m--)l=w(k[m],l);for(m=k.length-1;0<=m;m--)d=w(R(ub,rb,Nb(a,k[m])),d);return B(M,R(b,w(R(ub,rb,B(M,R(l,c))),d)))}
function X(a,b){function c(d,e,l,m){return X(l(d),l(e))&&X(m(d),m(e))?(I(d,e),!0):!1}if(a===b)return!0;a=G(a);b=G(b);if(a===b)return!0;if(A(a)){if(!A(b))return!1;I(a,z);I(b,z);return!0}return v(a)?v(b)?Bb(a,b):!1:x(a)?x(b)?c(a,b,ea,fa):!1:E(a)?E(b)?c(a,b,ka,la):!1:D(a)?D(b)?c(a,b,ha,ia):!1:g()}exports.equal_p=X;
function Y(a,b){function c(d,e,l,m){return Y(l(d),l(e))&&Y(m(d),m(e))?(I(d,e),!0):!1}if(a===b)return!0;a=Eb(a);b=Eb(b);if(a===b)return!0;if(A(a)){if(!A(b))return!1;I(a,z);I(b,z);return!0}if(v(a))return v(b)?Bb(a,b):!1;if(x(a))return x(b)?c(a,b,ea,fa):!1;if(E(a))return E(b)?c(a,b,ka,la):!1;if(D(a))return D(b)?c(a,b,ha,ia):!1;if(6===a[1])throw"WIP";if(7===a[1])throw"WIP";if(8===a[1])throw"WIP";if(9===a[1])throw"WIP";return g()}
function W(a){a=Eb(a);var b;if(A(a))return"()";if(x(a)){var c="(";for(b="";x(a);)c+=b+W(a[2]),b=" ",a=Eb(a[3]);return c=A(a)?c+")":c+(" . "+W(a)+")")}return D(a)?"#"+W(w(a[2],a[3])):E(a)?"!"+W(w(a[2],a[3])):v(a)?ba(a):6===a[1]?"$("+W(Gb(a[2]))+" "+W(a[3])+")":7===a[1]?"%("+W(a[2])+" "+W(T(a[3]))+")":8===a[1]?"@("+W(Gb(a[2]))+" "+W(a[3])+" "+W(T(a[4]))+")":9===a[1]?"^("+W(a[2])+" "+W(T(a[3]))+")":g()}exports.simple_print=W;exports.simple_print_force_all_rec=function(a){return W(oa(a))};
function Sb(a){function b(){return Ua.length===Ca}function c(){!b()||g();var f=Ua[Ca];Ca++;return f}function d(f){Ua[Ca-1]===f||g();Ca--}function e(f){void 0===f&&(f="");throw"TheLanguage parse ERROR!"+f;}function l(f){return" "===f||"\n"===f||"\t"===f||"\r"===f}function m(){if(b())return!1;var f=c();if(!l(f))return d(f),!1;for(;l(f)&&!b();)f=c();l(f)||d(f);return!0}function k(){if(b())return!1;var f=c(),t="";if(!J(f))return d(f),!1;for(;J(f)&&!b();)t+=f,f=c();J(f)?t+=f:d(f);t in aa||e("Not Symbol"+
t);return u(t)}function n(){if(b())return!1;var f=c();if("("!==f)return d(f),!1;for(var t=[10],h=t;;){m();if(b())return e();f=c();if(")"===f)return pa(t,z),h;if("."===f){m();f=ca();pa(t,f);m();if(b())return e();f=c();return")"!==f?e():h}d(f);f=ca();var r=[10];pa(t,w(f,r));t=r}}function p(){if(b())return!1;var f=c();if("#"!==f)return d(f),!1;f=n();return!1!==f&&x(f)?B(f[2],f[3]):e()}function C(){if(b())return!1;var f=c();if("!"!==f)return d(f),!1;f=n();return!1!==f&&x(f)?ja(f[2],f[3]):e()}function Q(f,
t){return function(){if(b())return!1;var h=c();if(h!==f)return d(h),!1;h=n();if(!1===h||!x(h))return e();var r=h[3];return x(r)&&A(r[3])?t(h[2],r[2]):e()}}function J(f){if(l(f))return!1;for(var t="()!#.$%^@~/->_:?[]&".split(""),h=0;h<t.length;h++)if(f===t[h])return!1;return!0}function ca(){m();for(var f=[n,Tb,p,C,Va,Wa,Xa,Ya],t=0;t<f.length;t++){var h=f[t]();if(!1!==h)return h}return e()}function H(f){return!1===f?e():f}function L(f){H(!b());H(c()===f)}function Da(){function f(r){function y(){L("[");
var Ub=f();L("]");return Ub}void 0===r&&(r=!1);r=r?[n,k,y,p,C,Va,Wa,Xa,Ya]:[n,Da,p,C,Va,Wa,Xa,Ya];for(var Za=0;Za<r.length;Za++){var vb=r[Za]();if(!1!==vb)return vb}return e()}function t(r){if(b())return r;var y=c();if("."===y)return y=f(),R(P,R(M,R(r),O),y);if(":"===y)return y=f(),R(P,y,r);if("~"===y)return R(wa,r);if("@"===y)return y=f(),R(P,R(M,w(r,O),O),y);if("?"===y)return R(P,M,R(wa,r));if("/"===y){for(r=[r];;){y=f(!0);r.push(y);if(b())break;y=c();if("/"!==y){d(y);break}}return R(xa,T(r))}d(y);
return r}if(b())return!1;var h=c();if("&"===h){H(!b());h=c();if("+"===h)return h=f(),R(N,R(K,h));d(h);h=f();return R(N,h)}if(":"===h){H(!b());h=c();if("&"===h)return L(">"),h=f(),R(P,R(N,R(M,O,h)),ta);if(">"===h)return h=f(),R(P,R(M,O,h),ta);d(h);h=f();return R(P,h,ta)}if("+"===h)return h=f(),R(K,h);if("["===h)return h=f(),L("]"),t(h);if("_"===h)return L(":"),h=f(),R(P,h,O);d(h);h=k();return!1===h?!1:t(h)}function Tb(){var f=Da();return!1===f?!1:v(f)?f:S(f)}var Ua=a,Ca=0,Va=Q("$",function(f,t){var h=
Pb(f);return!1===h?e():ma(h,t)}),Wa=Q("%",function(f,t){var h=Cb(t,function(r){return r},function(){return e()});return F(f,h)}),Xa=function(f,t){return function(){if(b())return!1;var h=c();if(h!==f)return d(h),!1;h=n();if(!1===h||!x(h))return e();var r=h[3];if(!x(r))return e();var y=r[3];return x(y)&&A(y[3])?t(h[2],r[2],y[2]):e()}}("@",function(f,t,h){h=Cb(h,function(r){return r},function(){return e()});f=Pb(f);return!1===f?e():[q,8,f,t,h]}),Ya=Q("^",function(f,t){var h=Cb(t,function(r){return r},
function(){return e()});return na(f,h)});return ca()}exports.complex_parse=Sb;
function Z(a){function b(e,l){function m(Q){return"inner"===l?"["+Q+"]":"top"===l?Q:g()}if(v(e))return ba(e);var k=Db(e);if(!1!==k&&3===k.length&&Y(k[0],P)){var n=Db(k[1]);if(!1!==n&&3===n.length&&Y(n[0],M)){var p=n[1],C=Db(p);if(!1!==C&&1===C.length&&Y(n[2],O))return m(b(C[0],"inner")+"."+b(k[2],"inner"));if(x(p)&&Y(p[3],O)&&Y(n[2],O))return m(b(p[2],"inner")+"@"+b(k[2],"inner"));if(Y(p,O)&&Y(k[2],ta))return m(":>"+b(n[2],"inner"))}p=Db(k[2]);if(Y(k[1],M)&&!1!==p&&2===p.length&&Y(p[0],wa))return m(b(p[1],
"inner")+"?");if(!1!==n&&2===n.length&&Y(k[2],ta)&&Y(n[0],N)&&(n=Db(n[1]),!1!==n&&3===n.length&&Y(n[0],M)&&Y(n[1],O)))return m(":&>"+b(n[2],"inner"));n=Y(k[2],O)?"_":Y(k[2],ta)?"":b(k[2],"inner");return m(n+":"+b(k[1],"inner"))}if(!1!==k&&2===k.length){if(Y(k[0],N))return n=Db(k[1]),!1!==n&&2===n.length&&Y(n[0],K)?m("&+"+b(n[1],"inner")):m("&"+b(k[1],"inner"));if(Y(k[0],wa))return m(b(k[1],"inner")+"~");if(Y(k[0],K))return m("+"+b(k[1],"inner"));if(Y(k[0],xa)&&(k=Db(k[1]),!1!==k&&1<k.length)){n=b(k[0],
"inner");for(p=1;p<k.length;p++)n+="/"+b(k[p],"inner");return m(n)}}return"inner"===l?W(e):"top"===l?W(S(e)):g()}a=Sb(W(a));var c="",d="";if(A(a))return"()";if(x(a)){c="(";for(d="";x(a);)c+=d+Z(a[2]),d=" ",a=a[3];return c=A(a)?c+")":c+(" . "+Z(a)+")")}return D(a)?(c=a[2],a=a[3],d=Db(a),!1!==d&&2===d.length&&Y(c,qa)&&Y(d[0],K)?b(d[1],"top"):"#"+Z(w(c,a))):E(a)?"!"+Z(w(a[2],a[3])):v(a)?ba(a):6===a[1]?"$("+Z(Gb(a[2]))+" "+Z(a[3])+")":7===a[1]?"%("+Z(a[2])+" "+Z(T(a[3]))+")":8===a[1]?"@("+Z(Gb(a[2]))+
" "+Z(a[3])+" "+Z(T(a[4]))+")":9===a[1]?"^("+Z(a[2])+" "+Z(T(a[3]))+")":g()}exports.complex_print=Z;
exports.machinetext_parse=function(a){function b(){function m(C){function Q(H){var L=[10],Da=[10];k.push(L);k.push(Da);pa(C,H(L,Da))}var J=c();if("$"===J){for(J="";;){var ca=c();if("$"===ca)break;J+=ca}pa(C,[q,0,J])}else if("."===J)Q(w);else if("#"===J)Q(B);else if("!"===J)Q(ja);else if("_"===J)pa(C,z);else throw"WIP";}for(var k=[],n=0,p=e;n<p.length;n++)m(p[n]);e=k}function c(){if(!(a.length>l))throw"MT parse ERROR";var m=a[l];l++;return m}for(var d=[10],e=[d],l=0;0!==e.length;)b();if(l!=a.length)throw"MT parse ERROR";
return d};exports.machinetext_print=function(a){function b(){for(var e=[],l=0,m=c;l<m.length;l++){var k=m[l];k=Eb(k);var n=function(p,C,Q,J){d+=C;e.push(Q(p));e.push(J(p))};if(v(k))d+="$",d+=k[2],d+="$";else if(x(k))n(k,".",ea,fa);else if(A(k))d+="_";else if(D(k))n(k,"#",ha,ia);else if(E(k))n(k,"!",ka,la);else throw"WIP";}c=e}for(var c=[a],d="";0!==c.length;)b();return d};
