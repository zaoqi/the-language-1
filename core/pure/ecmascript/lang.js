function g(){throw"TheLanguage PANIC";}function aa(a,b){return[11,a,b]}exports.new_comment=aa;exports.comment_p=function(a){return 11===a[0]};exports.comment_comment=function(a){return a[1]};exports.comment_x=function(a){return a[2]};
var ca={0:"0",1:"1",2:"2",3:"3",4:"4",5:"5",6:"6",7:"7",8:"8",9:"9",A:"A",B:"B",C:"C",D:"D",E:"E",F:"F",G:"G",H:"H",I:"I",J:"J",K:"K",L:"L",M:"M",N:"N",O:"O",P:"P",Q:"Q",R:"R",S:"S",T:"T",U:"U",V:"V",W:"W",X:"X",Y:"Y",Z:"Z",a:"a",b:"b",c:"c",d:"d",e:"e",f:"f",g:"g",h:"h",i:"i",j:"j",k:"k",l:"l",m:"m",n:"n",o:"o",p:"p",q:"q",r:"r",s:"s",t:"t",u:"u",v:"v",w:"w",x:"x",y:"y",z:"z","\u4e00\u985e\u4f55\u7269":"\u3749","\u4e4b\u7269":"\ud86d\ude66","\u5176\u5b50":"\ud85a\udfaa","\u51fa\u5165\u6539\u6ec5":"\ud849\udc9f",
"\u5217\u5e8f":"\ud841\udf3a","\u5316\u6ec5":"\ud840\udfc1","\u53c3\u5f62":"\ud842\udef0","\u543e\u81ea":"\ud85a\udcf9","\u592a\u59cb\u521d\u6838":"\ud84d\udf57","\u5982\u82e5":"\ud85b\udc61","\u5b87\u5b99\u4ea1\u77e3":"\ud863\ude79","\u5c3e\u672b":"\ud847\udcb5","\u5e8f\u4e01":"\ud840\udda4","\u5e8f\u4e19":"\ud840\uddee","\u5e8f\u4e59":"\u3408","\u5e8f\u7532":"\ud840\uddda","\u5f0f\u5f62":"\u4f71","\u5f15\u7528":"\u39c8","\u61c9\u7528":"\ud853\udc06","\u6548\u61c9":"\u52b9","\u6620\u8868":"\ud850\udd54",
"\u662f\u975e":"\u6b24","\u69cb\u7269":"\ud845\udcab","\u70ba\u7b26\u540d\u9023":"\u2010","\u7279\u5b9a\u5176\u7269":"\u4e93","\u7701\u7565\u4e00\u7269":"\u7567","\u7b26\u540d":"\u8b3c","\u7b49\u540c":"\u5f0c","\u89e3\u7b97":"\u7b6d","\u8a3b\u758f":"\u758e","\u8a5e\u7d20":"\ud85e\udd5d","\u8b2c\u8aa4":"\u4958","\u9023\u9838":"\u4e29","\u9593\u7a7a":"\ud84e\udcd3","\u9670":"\u4f8c","\u967d":"\ud84c\udd84","\u9996\u59cb":"\ud866\udc10"},da={0:"0",1:"1",2:"2",3:"3",4:"4",5:"5",6:"6",7:"7",8:"8",9:"9",
A:"A",B:"B",C:"C",D:"D",E:"E",F:"F",G:"G",H:"H",I:"I",J:"J",K:"K",L:"L",M:"M",N:"N",O:"O",P:"P",Q:"Q",R:"R",S:"S",T:"T",U:"U",V:"V",W:"W",X:"X",Y:"Y",Z:"Z",a:"a",b:"b",c:"c",d:"d",e:"e",f:"f",g:"g",h:"h",i:"i",j:"j",k:"k",l:"l",m:"m",n:"n",o:"o",p:"p",q:"q",r:"r",s:"s",t:"t",u:"u",v:"v",w:"w",x:"x",y:"y",z:"z","\u3749":"\u4e00\u985e\u4f55\u7269","\ud86d\ude66":"\u4e4b\u7269","\ud85a\udfaa":"\u5176\u5b50","\ud849\udc9f":"\u51fa\u5165\u6539\u6ec5","\ud841\udf3a":"\u5217\u5e8f","\ud840\udfc1":"\u5316\u6ec5",
"\ud842\udef0":"\u53c3\u5f62","\ud85a\udcf9":"\u543e\u81ea","\ud84d\udf57":"\u592a\u59cb\u521d\u6838","\ud85b\udc61":"\u5982\u82e5","\ud863\ude79":"\u5b87\u5b99\u4ea1\u77e3","\ud847\udcb5":"\u5c3e\u672b","\ud840\udda4":"\u5e8f\u4e01","\ud840\uddee":"\u5e8f\u4e19","\u3408":"\u5e8f\u4e59","\ud840\uddda":"\u5e8f\u7532","\u4f71":"\u5f0f\u5f62","\u39c8":"\u5f15\u7528","\ud853\udc06":"\u61c9\u7528","\u52b9":"\u6548\u61c9","\ud850\udd54":"\u6620\u8868","\u6b24":"\u662f\u975e","\ud845\udcab":"\u69cb\u7269",
"\u2010":"\u70ba\u7b26\u540d\u9023","\u4e93":"\u7279\u5b9a\u5176\u7269","\u7567":"\u7701\u7565\u4e00\u7269","\u8b3c":"\u7b26\u540d","\u5f0c":"\u7b49\u540c","\u7b6d":"\u89e3\u7b97","\u758e":"\u8a3b\u758f","\ud85e\udd5d":"\u8a5e\u7d20","\u4958":"\u8b2c\u8aa4","\u4e29":"\u9023\u9838","\ud84e\udcd3":"\u9593\u7a7a","\u4f8c":"\u9670","\ud84c\udd84":"\u967d","\ud866\udc10":"\u9996\u59cb"};function q(a){return 0===a[0]}exports.symbol_p=q;function ea(a){return a in ca}exports.can_new_symbol_p=ea;
function u(a){return[0,ca[a]]}exports.new_symbol=u;function fa(a){return da[a[1]]}exports.un_symbol=fa;function ha(a,b){return[1,a,b]}exports.new_construction=ha;function v(a){return 1===a[0]}exports.construction_p=v;function ia(a){return a[1]}exports.construction_head=ia;function ka(a){return a[2]}exports.construction_tail=ka;var w=[2];exports.null_v=w;function x(a){return 2===a[0]}exports.null_p=x;function la(a,b){return[3,a,b]}exports.new_data=la;function z(a){return 3===a[0]}exports.data_p=z;
function ma(a){return a[1]}exports.data_name=ma;function na(a){return a[2]}exports.data_list=na;function oa(a,b){return[4,a,b]}exports.new_error=oa;function A(a){return 4===a[0]}exports.error_p=A;function pa(a){return a[1]}exports.error_name=pa;function qa(a){return a[2]}exports.error_list=qa;function ra(a){return 5===a[0]}exports.just_p=ra;exports.evaluate=function(a,b){return[6,a,b]};function sa(a){return a[2]}function B(a,b){return[7,a,b]}exports.apply=function(a,b){return[9,a,b]};
function ta(a){a=D(a);if(z(a)||A(a)||v(a))a[1]=ta(a[1]),a[2]=ta(a[2]);return a}exports.force_all_rec=ta;function F(a,b){a!==b&&(a[0]=5,a[1]=b,a[2]=!1,a[3]=!1)}function va(a,b){10===a[0]||g();a[0]=b[0];a[1]=b[1];a[2]=b[2];a[3]=b[3]}
var G=u("\u592a\u59cb\u521d\u6838"),wa=u("\u7b26\u540d"),H=u("\u5316\u6ec5"),J=u("\u5f0f\u5f62"),xa=u("\u7279\u5b9a\u5176\u7269"),K=u("\u7701\u7565\u4e00\u7269"),ya=u("\u6620\u8868"),L=u("\u4e00\u985e\u4f55\u7269"),za=u("\u662f\u975e"),Aa=u("\u5176\u5b50"),Ba=u("\u967d"),Ca=u("\u9670"),Da=u("\u9023\u9838"),Ea=u("\u69cb\u7269"),Fa=u("\u8b2c\u8aa4"),Ga=u("\u5217\u5e8f"),Ha=u("\u8a3b\u758f"),Ia=[4,G,M(u("\u5b87\u5b99\u4ea1\u77e3"),K)];function N(a){return[3,wa,[1,G,[1,a,w]]]}
function Ja(a){return N(M(L,M(H,K,a),xa))}function Ka(a,b){return N(M(L,M(H,M(a),K),b))}function La(a){return N(M(L,H,M(za,M(L,a,K))))}
var Ma=Ja(Ea),Na=Ka(Ea,wa),Oa=Ka(Ea,Ga),Qa=La(Ea),Ra=Ja(Fa),Sa=Ka(Fa,wa),Ta=Ka(Fa,Ga),Ua=La(Fa),Va=Ja(Da),Wa=La(Da),Xa=Ka(Da,u("\u9996\u59cb")),bb=Ka(Da,u("\u5c3e\u672b")),cb=La(u("\u8a5e\u7d20")),db=La(u("\u9593\u7a7a")),eb=N(M(L,H,M(za,u("\u7b49\u540c")))),fb=N(M(L,M(H,[1,H,K],K),u("\u61c9\u7528"))),gb=N(M(L,H,u("\u89e3\u7b97"))),hb=Ka(Ga,M(L,u("\u4e4b\u7269"),K)),ib=N(M(L,H,u("\u5982\u82e5"))),jb=N(M(L,J,u("\u5f15\u7528"))),kb=N(M(L,M(J,M(H,K,H)),xa)),lb=N(M(J,M(G,H))),mb=N(M(J,M(G,J))),nb=N(M(J,
J)),ob=N(M(L,H,Ha)),pb=N(M(L,J,Ha)),qb=[3,Ca,M()],rb=[3,Ba,M()];function sb(a,b){return a===b?!0:a[1]===b[1]?(F(a,b),!0):!1}function P(a){for(var b=w,c=a.length-1;0<=c;c--)b=[1,a[c],b];return b}exports.jsArray_to_list=P;function tb(a,b,c){for(var d=[];v(a);)d.push(a[1]),a=a[2];return x(a)?b(d):c(d,a)}function ub(a){return tb(a,function(b){return b},function(){return!1})}exports.maybe_list_to_jsArray=ub;function M(){for(var a=[],b=0;b<arguments.length;b++)a[b]=arguments[b];return P(a)}
exports.new_list=M;function vb(a){for(var b=[];ra(a);)b.push(a),a=a[1];for(var c=0;c<b.length;c++)F(b[c],a);return a}exports.un_just=vb;function wb(a){return 6===a[0]||8===a[0]||7===a[0]||9===a[0]}exports.delay_p=wb;function Q(a){return ra(a)||wb(a)}exports.delay_just_p=Q;function xb(a){if(6===a[0])return a;if(8===a[0])throw"WIP";if(7===a[0])throw"WIP";if(9===a[0])throw"WIP";return g()}exports.delay_env=function(a){return xb(a)[1]};exports.delay_x=function(a){return xb(a)[2]};
function D(a,b,c,d){function e(E){F(p,E);for(var I=0;I<d.length;I++)F(d[I],E);return E}function l(){c[1]=!0;return m(Ia)}function m(E){e(E);return Q(E)?(d.push(p),D(E,b,[!1,!1],d)):E}function h(){var E={},I;for(I in n)E[I]=!0;for(I in b)E[I]=!0;return E}void 0===b&&(b={});void 0===c&&(c=[!1,!1]);void 0===d&&(d=[]);var n={},p=a;for(a=0;Q(p)&&32>a;a++)d.push(p),p=R(p);for(;Q(p);){a=S(p);if(!0===b[a])return l();if(!0===n[a]){c[0]=!0;if(6===p[0])return l();if(7===p[0]){a=p[1];for(var C=p[2],O=!1,V=0,
ba=[Na,Oa,Qa,Sa,Ta,Ua,Wa,Xa,bb,cb,db];V<ba.length;V++)if(T(ba[V],a)){O=!0;break}if(O)return 1===C.length||g(),!1===c[1]||g(),C=D(C[0],h(),c),c[1]?m(B(a,[C])):g();if(T(a,eb)||T(a,fb)||T(a,gb))return l();if(T(a,ib)&&(3===C.length||g(),!1===c[1]||g(),a=D(C[0],h(),c),c[1]))return m(B(ib,[a,C[1],C[2]]))}else if(8===p[0]||9===p[0])return l();return g()}n[a]=!0;d.push(p);p=R(p)}return e(p)}
function R(a){var b=vb(a);!ra(b)||g();if(6===b[0])a=yb(b[1],b[2],a);else if(8===b[0]){a=b[1];var c=b[2],d=b[3],e=[4,G,M(mb,M(W(a),c,P(d)))];a=T(c,jb)?1!==d.length?e:d[0]:T(c,kb)?2!==d.length?e:Ab(a,d[0],d[1],e):T(c,pb)?2!==d.length?e:[11,d[0],[6,a,d[1]]]:e}else if(7===b[0])a:{e=b[1];a=b[2];c=[4,G,M(lb,M(e,P(a)))];for(d=0;d<Bb.length;d++)if(T(e,Bb[d][0])){e=Bb[d][1];if(a.length!==e)break;d=Bb[d][2];a=1===e?d(a[0],c):2===e?d(a[0],a[1],c):3===e?d(a[0],a[1],a[2],c):g();break a}a=c}else a=9===b[0]?Cb(b[1],
b[2],a):b;a=vb(a);F(b,a);return a}exports.force1=R;exports.force_all=function(a){return D(a)};var Db=[];exports.env_null_v=Db;function Eb(a,b,c){for(var d=[],e=0;e<a.length;e+=2){if(T(a[e],b)){d[e]=b;d[e+1]=c;for(e+=2;e<a.length;e+=2)d[e]=a[e],d[e+1]=a[e+1];return d}d[e]=a[e];d[e+1]=a[e+1]}d[a.length]=b;d[a.length+1]=c;return d}exports.env_set=Eb;function Fb(a,b,c){for(var d=0;d<a.length;d+=2)if(T(a[d],b))return a[d+1];return c}exports.env_get=Fb;
function Gb(a,b){for(var c=0;c<a.length;c+=2)if(T(a[c],b))return a[c+1];return g()}function W(a){for(var b=w,c=0;c<a.length;c+=2)b=[1,M(a[c],a[c+1]),b];return[3,ya,M(b)]}exports.env2val=W;function Hb(a,b){for(var c=0;c<a.length;c+=2)b(a[c],a[c+1])}exports.env_foreach=Hb;
function Ib(a){a=D(a);if(!z(a))return!1;var b=D(a[1]);if(!q(b)||!sb(b,ya))return!1;b=D(a[2]);if(!v(b)||!x(D(b[2])))return!1;a=[];for(b=D(b[1]);!x(b);){if(!v(b))return!1;var c=D(b[1]);b=D(b[2]);if(!v(c))return!1;var d=c[1];c=D(c[2]);if(!v(c))return!1;var e=c[1];if(!x(D(c[2])))return!1;c=!0;for(var l=0;l<a.length;l+=2)if(T(a[l],d)){a[l+1]=e;c=!1;break}c&&(a.push(d),a.push(e))}return a}exports.val2env=Ib;
function yb(a,b,c){var d=R(b);if(Q(d))return c;var e=[4,G,M(lb,M(gb,M(W(a),d)))];if(v(d)){for(b=[];!x(d);){if(Q(d))return c;if(v(d))b.push(d[1]),d=R(d[2]);else return e}if(T(b[0],mb)){if(1===b.length)return e;d=b[1];c=[];for(e=2;e<b.length;e++)c.push(b[e]);return[8,a,d,c]}if(T(b[0],nb)){if(1===b.length)return e;d=D([6,a,b[1]]);if(!z(d))return e;var l=R(d[1]);if(Q(l))return c;if(!q(l)||!sb(l,J))return e;l=R(d[2]);if(Q(l))return c;if(!v(l))return e;d=l[1];l=R(l[2]);if(Q(l))return c;if(!x(l))return e;
c=[W(a)];for(e=2;e<b.length;e++)c.push(b[e]);return[9,d,c]}if(T(b[0],lb)){if(1===b.length)return e;d=b[1];c=[];for(e=2;e<b.length;e++)c.push([6,a,b[e]]);return[7,d,c]}d=[6,a,b[0]];c=[];for(e=1;e<b.length;e++)c.push([6,a,b[e]]);return[9,d,c]}return x(d)?d:q(d)||z(d)?Fb(a,d,e):A(d)?e:g()}function Jb(a,b){return[a,1,function(c){c=R(c);return Q(c)?B(a,[c]):b(c)?rb:qb}]}function Kb(a,b,c){return[a,1,function(d,e){d=R(d);return Q(d)?B(a,[d]):b(d)?c(d):e}]}
var Bb=[Jb(Qa,z),[Ma,2,la],Kb(Na,z,ma),Kb(Oa,z,na),Jb(Ua,A),[Ra,2,oa],Kb(Sa,A,pa),Kb(Ta,A,qa),Jb(db,x),[Va,2,ha],Jb(Wa,v),Kb(Xa,v,ia),Kb(bb,v,ka),[eb,2,function(a,b){function c(d,e,l,m){l=B(eb,[l(d),l(e)]);d=B(eb,[m(d),m(e)]);return B(ib,[l,d,qb])}if(a===b)return rb;a=R(a);b=R(b);if(Q(a)||Q(b))return B(eb,[a,b]);if(a===b)return rb;!Q(a)||g();return x(a)?x(a)?rb:qb:q(a)?q(b)?sb(a,b)?rb:qb:qb:z(a)?z(b)?c(a,b,ma,na):qb:v(a)?v(b)?c(a,b,ia,ka):qb:A(a)?A(b)?c(a,b,pa,qa):qb:g()}],[fb,2,function(a,b,c){var d=
[];for(b=D(b);v(b);)d.push(b[1]),b=D(b[2]);return x(b)?[9,a,d]:c}],[gb,2,function(a,b,c){a=Ib(a);return!1===a?c:[6,a,b]}],Jb(cb,q),[hb,1,function(a,b){a=R(a);return Q(a)?B(hb,[a]):v(a)?a[1]:b}],[ib,3,function(a,b,c,d){a=R(a);if(Q(a))return B(ib,[a,b,c]);if(!z(a))return d;a=D(a[1]);return q(a)?sb(a,Ba)?b:sb(a,Ca)?c:d:d}],[ob,2,aa]];
function Cb(a,b,c){function d(){return[4,G,M(lb,M(fb,M(a,P(b))))]}a=R(a);if(Q(a))return c;if(!z(a))return d();c=D(a[1]);if(!q(c)||!sb(c,H))return d();var e=D(a[2]);if(!v(e))return d();c=ta(e[1]);e=D(e[2]);if(!v(e)||!x(D(e[2])))return d();e=e[1];for(var l=Db,m=0;!x(c);)if(q(c)||z(c)){for(var h=w,n=b.length-1;n>=m;n--)h=[1,b[n],h];l=Eb(l,c,h);m=b.length;c=w}else if(v(c))if(m<b.length)h=b[m],m++,l=Eb(l,c[1],h),c=c[2];else return d();else return d();return b.length!==m?d():[6,l,e]}
function Ab(a,b,c,d){void 0===d&&(d=!1);b=ta(b);for(var e=[],l=!1,m=b;!x(m);)if(q(m)||z(m))e.push(m),l=!0,m=w;else if(v(m))e.push(m[1]),m=m[2];else return!1===d?oa(G,M(mb,M(W(a),kb,P([b,c])))):d;d=b;l&&(d=P(e));var h=[];Hb(a,function(n){for(var p=0;p<e.length;p++)if(T(e[p],n))return;h.push(n)});l=d;for(m=h.length-1;0<=m;m--)l=[1,h[m],l];for(m=h.length-1;0<=m;m--)d=ha(M(mb,jb,Gb(a,h[m])),d);return[3,H,M(b,[1,M(mb,jb,[3,H,M(l,c)]),d])]}
function T(a,b){function c(d,e,l,m){return T(l(d),l(e))&&T(m(d),m(e))?(F(d,e),!0):!1}if(a===b)return!0;a=D(a);b=D(b);if(a===b)return!0;if(x(a)){if(!x(b))return!1;F(a,w);F(b,w);return!0}return q(a)?q(b)?sb(a,b):!1:v(a)?v(b)?c(a,b,ia,ka):!1:A(a)?A(b)?c(a,b,pa,qa):!1:z(a)?z(b)?c(a,b,ma,na):!1:g()}exports.equal_p=T;
function X(a,b){function c(d,e,l,m){return X(l(d),l(e))&&X(m(d),m(e))?(F(d,e),!0):!1}if(a===b)return!0;a=vb(a);b=vb(b);if(a===b)return!0;if(x(a)){if(!x(b))return!1;F(a,w);F(b,w);return!0}if(q(a))return q(b)?sb(a,b):!1;if(v(a))return v(b)?c(a,b,ia,ka):!1;if(A(a))return A(b)?c(a,b,pa,qa):!1;if(z(a))return z(b)?c(a,b,ma,na):!1;if(6===a[0])throw"WIP";if(7===a[0])throw"WIP";if(8===a[0])throw"WIP";if(9===a[0])throw"WIP";return g()}
function S(a){a=vb(a);var b;if(x(a))return"()";if(v(a)){var c="(";for(b="";v(a);)c+=b+S(a[1]),b=" ",a=vb(a[2]);return c=x(a)?c+")":c+(" . "+S(a)+")")}return z(a)?"#"+S([1,a[1],a[2]]):A(a)?"!"+S([1,a[1],a[2]]):q(a)?fa(a):6===a[0]?"$("+S(W(a[1]))+" "+S(a[2])+")":7===a[0]?"%("+S(a[1])+" "+S(P(a[2]))+")":8===a[0]?"@("+S(W(a[1]))+" "+S(a[2])+" "+S(P(a[3]))+")":9===a[0]?"^("+S(a[1])+" "+S(P(a[2]))+")":g()}exports.simple_print=S;exports.simple_print_force_all_rec=function(a){return S(ta(a))};
function Lb(a){function b(){return ja.length===Z}function c(){!b()||g();var f=ja[Z];Z++;return f}function d(f){ja[Z-1]===f||g();Z--}function e(f){void 0===f&&(f="");throw"TheLanguage parse ERROR!"+f;}function l(f){return" "===f||"\n"===f||"\t"===f||"\r"===f}function m(){if(b())return!1;var f=c();if(!l(f))return d(f),!1;for(;l(f)&&!b();)f=c();l(f)||d(f);return!0}function h(){if(b())return!1;var f=c(),t="";if(!V(f))return d(f),!1;for(;V(f)&&!b();)t+=f,f=c();V(f)?t+=f:d(f);return ea(t)?u(t):e("Not Symbol"+
t)}function n(){if(b())return!1;var f=c();if("("!==f)return d(f),!1;for(var t=[10],k=t;;){m();if(b())return e();f=c();if(")"===f)return va(t,w),k;if("."===f){m();f=ba();va(t,f);m();if(b())return e();f=c();return")"!==f?e():k}d(f);f=ba();var r=[10];va(t,[1,f,r]);t=r}}function p(){if(b())return!1;var f=c();if("#"!==f)return d(f),!1;f=n();return!1!==f&&v(f)?[3,f[1],f[2]]:e()}function C(){if(b())return!1;var f=c();if("!"!==f)return d(f),!1;f=n();return!1!==f&&v(f)?[4,f[1],f[2]]:e()}function O(f,t){return function(){if(b())return!1;
var k=c();if(k!==f)return d(k),!1;k=n();if(!1===k||!v(k))return e();var r=k[2];return v(r)&&x(r[2])?t(k[1],r[1]):e()}}function V(f){if(l(f))return!1;for(var t="()!#.$%^@~/->_:?[]&".split(""),k=0;k<t.length;k++)if(f===t[k])return!1;return!0}function ba(){m();for(var f=[n,Pa,p,C,ua,Ya,Za,$a],t=0;t<f.length;t++){var k=f[t]();if(!1!==k)return k}return e()}function E(f){return!1===f?e():f}function I(f){E(!b());E(c()===f)}function U(){function f(r){function y(){I("[");var Mb=f();I("]");return Mb}void 0===
r&&(r=!1);r=r?[n,h,y,p,C,ua,Ya,Za,$a]:[n,U,p,C,ua,Ya,Za,$a];for(var ab=0;ab<r.length;ab++){var zb=r[ab]();if(!1!==zb)return zb}return e()}function t(r){if(b())return r;var y=c();if("."===y)return y=f(),M(L,M(H,M(r),K),y);if(":"===y)return y=f(),M(L,y,r);if("~"===y)return M(za,r);if("@"===y)return y=f(),M(L,M(H,[1,r,K],K),y);if("?"===y)return M(L,H,M(za,r));if("/"===y){for(r=[r];;){y=f(!0);r.push(y);if(b())break;y=c();if("/"!==y){d(y);break}}return M(Aa,P(r))}d(y);return r}if(b())return!1;var k=c();
if("&"===k){E(!b());k=c();if("+"===k)return k=f(),M(J,M(G,k));d(k);k=f();return M(J,k)}if(":"===k){E(!b());k=c();if("&"===k)return I(">"),k=f(),M(L,M(J,M(H,K,k)),xa);if(">"===k)return k=f(),M(L,M(H,K,k),xa);d(k);k=f();return M(L,k,xa)}if("+"===k)return k=f(),M(G,k);if("["===k)return k=f(),I("]"),t(k);if("_"===k)return I(":"),k=f(),M(L,k,K);d(k);k=h();return!1===k?!1:t(k)}function Pa(){var f=U();return!1===f?!1:q(f)?f:N(f)}var ja=a,Z=0,ua=O("$",function(f,t){var k=Ib(f);return!1===k?e():[6,k,t]}),
Ya=O("%",function(f,t){var k=tb(t,function(r){return r},function(){return e()});return[7,f,k]}),Za=function(f,t){return function(){if(b())return!1;var k=c();if(k!==f)return d(k),!1;k=n();if(!1===k||!v(k))return e();var r=k[2];if(!v(r))return e();var y=r[2];return v(y)&&x(y[2])?t(k[1],r[1],y[1]):e()}}("@",function(f,t,k){k=tb(k,function(r){return r},function(){return e()});f=Ib(f);return!1===f?e():[8,f,t,k]}),$a=O("^",function(f,t){var k=tb(t,function(r){return r},function(){return e()});return[9,
f,k]});return ba()}exports.complex_parse=Lb;
function Y(a){function b(e,l){function m(O){return"inner"===l?"["+O+"]":"top"===l?O:g()}if(q(e))return fa(e);var h=ub(e);if(!1!==h&&3===h.length&&X(h[0],L)){var n=ub(h[1]);if(!1!==n&&3===n.length&&X(n[0],H)){var p=n[1],C=ub(p);if(!1!==C&&1===C.length&&X(n[2],K))return m(b(C[0],"inner")+"."+b(h[2],"inner"));if(v(p)&&X(p[2],K)&&X(n[2],K))return m(b(p[1],"inner")+"@"+b(h[2],"inner"));if(X(p,K)&&X(h[2],xa))return m(":>"+b(n[2],"inner"))}p=ub(h[2]);if(X(h[1],H)&&!1!==p&&2===p.length&&X(p[0],za))return m(b(p[1],
"inner")+"?");if(!1!==n&&2===n.length&&X(h[2],xa)&&X(n[0],J)&&(n=ub(n[1]),!1!==n&&3===n.length&&X(n[0],H)&&X(n[1],K)))return m(":&>"+b(n[2],"inner"));n=X(h[2],K)?"_":X(h[2],xa)?"":b(h[2],"inner");return m(n+":"+b(h[1],"inner"))}if(!1!==h&&2===h.length){if(X(h[0],J))return n=ub(h[1]),!1!==n&&2===n.length&&X(n[0],G)?m("&+"+b(n[1],"inner")):m("&"+b(h[1],"inner"));if(X(h[0],za))return m(b(h[1],"inner")+"~");if(X(h[0],G))return m("+"+b(h[1],"inner"));if(X(h[0],Aa)&&(h=ub(h[1]),!1!==h&&1<h.length)){n=b(h[0],
"inner");for(p=1;p<h.length;p++)n+="/"+b(h[p],"inner");return m(n)}}return"inner"===l?S(e):"top"===l?S(N(e)):g()}a=Lb(S(a));var c="",d="";if(x(a))return"()";if(v(a)){c="(";for(d="";v(a);)c+=d+Y(a[1]),d=" ",a=a[2];return c=x(a)?c+")":c+(" . "+Y(a)+")")}return z(a)?(c=a[1],a=a[2],d=ub(a),!1!==d&&2===d.length&&X(c,wa)&&X(d[0],G)?b(d[1],"top"):"#"+Y([1,c,a])):A(a)?"!"+Y([1,a[1],a[2]]):q(a)?fa(a):6===a[0]?"$("+Y(W(a[1]))+" "+Y(a[2])+")":7===a[0]?"%("+Y(a[1])+" "+Y(P(a[2]))+")":8===a[0]?"@("+Y(W(a[1]))+
" "+Y(a[2])+" "+Y(P(a[3]))+")":9===a[0]?"^("+Y(a[1])+" "+Y(P(a[2]))+")":g()}exports.complex_print=Y;
exports.machinetext_parse=function(a){function b(){function p(E){function I(ja){var Z=[10],ua=[10];C.push(Z);C.push(ua);va(E,ja(Z,ua))}var U=e();if("^"===U){for(U="";;){var Pa=e();if("^"===Pa)break;U+=Pa}if(U in da)va(E,[0,U]);else return{value:c()}}else if("."===U)I(ha);else if("#"===U)I(la);else if("!"===U)I(oa);else if("$"===U)I(function(ja,Z){return[6,Db,M(lb,gb,M(mb,jb,ja),M(mb,jb,Z))]});else if("_"===U)va(E,w);else return{value:c()}}for(var C=[],O=0,V=m;O<V.length;O++){var ba=p(V[O]);if("object"===
typeof ba)return ba}m=C}function c(){throw"MT parse ERROR";}function d(p){if(!p)return c()}function e(){d(a.length>h);var p=a[h];h++;return p}for(var l=[10],m=[l],h=0;0!==m.length;){var n=b();if("object"===typeof n)return n.value}d(h==a.length);return l};
exports.machinetext_print=function(a){function b(){for(var e=[],l=0,m=c;l<m.length;l++){var h=m[l];h=vb(h);var n=function(p,C,O,V){d+=C;e.push(O(p));e.push(V(p))};if(q(h))d+="^",d+=h[1],d+="^";else if(v(h))n(h,".",ia,ka);else if(x(h))d+="_";else if(z(h))n(h,"#",ma,na);else if(A(h))n(h,"!",pa,qa);else if(wb(h))h=xb(h),n(h,"$",function(p){return W(p[1])},sa);else return{value:g()}}c=e}for(var c=[a],d="";0!==c.length;)if(a=b(),"object"===typeof a)return a.value;return d};var Nb=Lb("\u6548\u61c9/[:\u4e4b\u7269]");
exports.return_effect_systemName=Nb;var Ob=Lb("\u6548\u61c9/\u9023\u9838");exports.bind_effect_systemName=Ob;exports.run_effect_helper=function(){throw"WIP";};
