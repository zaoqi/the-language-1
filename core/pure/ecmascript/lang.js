function h(){throw"TheLanguage PANIC";}function q(a){a in aa||h();return[0,aa[a]]}exports.new_symbol=q;function u(a){return 0===a[0]}exports.symbol_p=u;function ba(a){return ca[a[1]]}exports.un_symbol=ba;function da(a,b){return[1,a,b]}exports.new_construction=da;function v(a){return 1===a[0]}exports.construction_p=v;function ea(a){return a[1]}exports.construction_head=ea;function fa(a){return a[2]}exports.construction_tail=fa;var w=[2];exports.null_v=w;function x(a){return 2===a[0]}
exports.null_p=x;function ha(a,b){return[3,a,b]}exports.new_data=ha;function z(a){return 3===a[0]}exports.data_p=z;function ia(a){return a[1]}exports.data_name=ia;function ja(a){return a[2]}exports.data_list=ja;function ka(a,b){return[4,a,b]}exports.new_error=ka;function A(a){return 4===a[0]}exports.error_p=A;function la(a){return a[1]}exports.error_name=la;function ma(a){return a[2]}exports.error_list=ma;exports.evaluate=function(a,b){return[6,a,b]};function C(a,b){return[7,a,b]}
exports.apply=function(a,b){return[9,a,b]};function na(a){a=D(a);if(z(a)||A(a)||v(a)){var b=a[2];a[1]=na(a[1]);a[2]=na(b)}return a}exports.force_all_rec=na;function E(a,b){a!==b&&(a[0]=5,a[1]=b,a[2]=!1,a[3]=!1)}function oa(a,b){10===a[0]||h();a[0]=b[0];a[1]=b[1];a[2]=b[2];a[3]=b[3]}
var aa={0:"0",1:"1",2:"2",3:"3",4:"4",5:"5",6:"6",7:"7",8:"8",9:"9",A:"A",B:"B",C:"C",D:"D",E:"E",F:"F",G:"G",H:"H",I:"I",J:"J",K:"K",L:"L",M:"M",N:"N",O:"O",P:"P",Q:"Q",R:"R",S:"S",T:"T",U:"U",V:"V",W:"W",X:"X",Y:"Y",Z:"Z",a:"a",b:"b",c:"c",d:"d",e:"e",f:"f",g:"g",h:"h",i:"i",j:"j",k:"k",l:"l",m:"m",n:"n",o:"o",p:"p",q:"q",r:"r",s:"s",t:"t",u:"u",v:"v",w:"w",x:"x",y:"y",z:"z","\u4e00\u985e\u4f55\u7269":"\uff1a","\u4e4b\u7269":"\u7269","\u5176\u5b50":"\u5206","\u51fa\u5165\u6539\u6ec5":"\u8b8a","\u5217\u5e8f":"\u5217",
"\u5316\u6ec5":"\u5316","\u53c3\u5f62":"\u53c3","\u543e\u81ea":"\u81ea","\u592a\u59cb\u521d\u6838":"\u6838","\u5982\u82e5":"\u82e5","\u5b87\u5b99\u4ea1\u77e3":"\u6b62","\u5c3e\u672b":"\u5c3e","\u5e8f\u4e01":"\u4e01","\u5e8f\u4e19":"\u4e19","\u5e8f\u4e59":"\u4e59","\u5e8f\u7532":"\u7532","\u5f0f\u5f62":"\u5f62","\u5f15\u7528":"\u5f15","\u61c9\u7528":"\u7528","\u6548\u61c9":"\u6548","\u6620\u8868":"\u8868","\u662f\u975e":"\u6b24","\u69cb\u7269":"\u69cb","\u70ba\u7b26\u540d\u9023":"\u2010","\u7279\u5b9a\u5176\u7269":"\u7368",
"\u7701\u7565\u4e00\u7269":"\u67d0","\u7b26\u540d":"\u7b26","\u7b49\u540c":"\u7b49","\u89e3\u7b97":"\u7b97","\u8a5e\u7d20":"\u6587","\u8b2c\u8aa4":"\u8b2c","\u9023\u9838":"\u9023","\u9593\u7a7a":"\u7a7a","\u9670":"\u9670","\u967d":"\u967d","\u9996\u59cb":"\u9996"},ca={0:"0",1:"1",2:"2",3:"3",4:"4",5:"5",6:"6",7:"7",8:"8",9:"9",A:"A",B:"B",C:"C",D:"D",E:"E",F:"F",G:"G",H:"H",I:"I",J:"J",K:"K",L:"L",M:"M",N:"N",O:"O",P:"P",Q:"Q",R:"R",S:"S",T:"T",U:"U",V:"V",W:"W",X:"X",Y:"Y",Z:"Z",a:"a",b:"b",c:"c",
d:"d",e:"e",f:"f",g:"g",h:"h",i:"i",j:"j",k:"k",l:"l",m:"m",n:"n",o:"o",p:"p",q:"q",r:"r",s:"s",t:"t",u:"u",v:"v",w:"w",x:"x",y:"y",z:"z","\uff1a":"\u4e00\u985e\u4f55\u7269","\u7269":"\u4e4b\u7269","\u5206":"\u5176\u5b50","\u8b8a":"\u51fa\u5165\u6539\u6ec5","\u5217":"\u5217\u5e8f","\u5316":"\u5316\u6ec5","\u53c3":"\u53c3\u5f62","\u81ea":"\u543e\u81ea","\u6838":"\u592a\u59cb\u521d\u6838","\u82e5":"\u5982\u82e5","\u6b62":"\u5b87\u5b99\u4ea1\u77e3","\u5c3e":"\u5c3e\u672b","\u4e01":"\u5e8f\u4e01","\u4e19":"\u5e8f\u4e19",
"\u4e59":"\u5e8f\u4e59","\u7532":"\u5e8f\u7532","\u5f62":"\u5f0f\u5f62","\u5f15":"\u5f15\u7528","\u7528":"\u61c9\u7528","\u6548":"\u6548\u61c9","\u8868":"\u6620\u8868","\u6b24":"\u662f\u975e","\u69cb":"\u69cb\u7269","\u2010":"\u70ba\u7b26\u540d\u9023","\u7368":"\u7279\u5b9a\u5176\u7269","\u67d0":"\u7701\u7565\u4e00\u7269","\u7b26":"\u7b26\u540d","\u7b49":"\u7b49\u540c","\u7b97":"\u89e3\u7b97","\u6587":"\u8a5e\u7d20","\u8b2c":"\u8b2c\u8aa4","\u9023":"\u9023\u9838","\u7a7a":"\u9593\u7a7a","\u9670":"\u9670",
"\u967d":"\u967d","\u9996":"\u9996\u59cb"},F=q("\u592a\u59cb\u521d\u6838"),pa=q("\u7b26\u540d"),H=q("\u5316\u6ec5"),I=q("\u5f0f\u5f62"),qa=q("\u7b49\u540c"),ra=q("\u89e3\u7b97"),sa=q("\u7279\u5b9a\u5176\u7269"),K=q("\u7701\u7565\u4e00\u7269"),ta=q("\u6620\u8868"),ua=q("\u5982\u82e5"),M=q("\u4e00\u985e\u4f55\u7269"),va=q("\u662f\u975e"),wa=q("\u5176\u5b50"),za=q("\u967d"),Aa=q("\u9670"),Ba=q("\u5f15\u7528"),Ca=q("\u61c9\u7528"),Da=q("\u9593\u7a7a"),Ea=q("\u9023\u9838"),Fa=q("\u69cb\u7269"),Ga=q("\u8b2c\u8aa4"),
Ha=q("\u8a5e\u7d20"),Ia=q("\u5217\u5e8f"),Ja=q("\u9996\u59cb"),Ka=q("\u5c3e\u672b"),La=q("\u4e4b\u7269"),Ma=q("\u5b87\u5b99\u4ea1\u77e3"),Na=[4,F,N(Ma,K)];function P(a){return[3,pa,N(F,a)]}function Oa(a){return P(N(M,N(H,K,a),sa))}function Pa(a,b){return P(N(M,N(H,N(a),K),b))}function Qa(a){return P(N(M,H,N(va,N(M,a,K))))}
var Xa=Oa(Fa),Ya=Pa(Fa,pa),Za=Pa(Fa,Ia),$a=Qa(Fa),ab=Oa(Ga),bb=Pa(Ga,pa),cb=Pa(Ga,Ia),db=Qa(Ga),eb=Oa(Ea),fb=Qa(Ea),gb=Pa(Ea,Ja),hb=Pa(Ea,Ka),ib=Qa(Ha),jb=Qa(Da),kb=P(N(M,H,N(va,qa))),lb=P(N(M,N(H,[1,H,K],K),Ca)),mb=P(N(M,H,ra)),nb=Pa(Ia,N(M,La,K)),ob=P(N(M,H,ua)),pb=P(N(M,I,Ba)),qb=P(N(M,N(I,N(H,K,H)),sa)),sb=P(N(I,N(F,H))),tb=P(N(I,N(F,I))),ub=P(N(I,I)),vb=[3,Aa,N()],wb=[3,za,N()];function xb(a,b){return a===b?!0:a[1]===b[1]?(E(a,b),!0):!1}
function Q(a){for(var b=w,c=a.length-1;0<=c;c--)b=[1,a[c],b];return b}exports.jsArray_to_list=Q;function yb(a,b,c){for(var d=[];v(a);)d.push(a[1]),a=a[2];return x(a)?b(d):c(d,a)}function R(a){return yb(a,function(b){return b},function(){return!1})}exports.maybe_list_to_jsArray=R;function N(){for(var a=[],b=0;b<arguments.length;b++)a[b]=arguments[b];return Q(a)}exports.new_list=N;function zb(a){for(var b=[];5===a[0];)b.push(a),a=a[1];for(var c=0;c<b.length;c++)E(b[c],a);return a}
function S(a){return 5===a[0]||6===a[0]||8===a[0]||7===a[0]||9===a[0]}exports.delay_p=S;
function D(a,b,c,d){function e(G){E(p,G);for(var L=0;L<d.length;L++)E(d[L],G);return G}function l(){c[1]=!0;return m(Na)}function m(G){e(G);return S(G)?(d.push(p),D(G,b,[!1,!1],d)):G}function k(){var G={},L;for(L in n)G[L]=!0;for(L in b)G[L]=!0;return G}void 0===b&&(b={});void 0===c&&(c=[!1,!1]);void 0===d&&(d=[]);var n={},p=a;for(a=0;S(p)&&32>a;a++)d.push(p),p=T(p);for(;S(p);){a=U(p);if(!0===b[a])return l();if(!0===n[a]){c[0]=!0;if(6===p[0])return l();if(7===p[0]){a=p[1];for(var B=p[2],O=!1,J=0,
Y=[Ya,Za,$a,bb,cb,db,fb,gb,hb,ib,jb];J<Y.length;J++)if(V(Y[J],a)){O=!0;break}if(O)return 1===B.length||h(),!1===c[1]||h(),B=D(B[0],k(),c),c[1]?m(C(a,[B])):h();if(V(a,kb)||V(a,lb)||V(a,mb))return l();if(V(a,ob)&&(3===B.length||h(),!1===c[1]||h(),a=D(B[0],k(),c),c[1]))return m(C(ob,[a,B[1],B[2]]))}else if(8===p[0]||9===p[0])return l();return h()}n[a]=!0;d.push(p);p=T(p)}return e(p)}exports.force_all=D;
function T(a){var b=zb(a);5!==b[0]||h();if(6===b[0])a=Ab(b[1],b[2],a);else if(8===b[0]){a=b[1];var c=b[2],d=b[3],e=[4,F,N(tb,N(W(a),c,Q(d)))];a=V(c,pb)?1!==d.length?e:d[0]:V(c,qb)?2!==d.length?e:Bb(a,d[0],d[1],e):e}else if(7===b[0])a:{e=b[1];a=b[2];c=[4,F,N(sb,N(e,Q(a)))];for(d=0;d<Cb.length;d++)if(V(e,Cb[d][0])){e=Cb[d][1];if(a.length!==e)break;d=Cb[d][2];a=1===e?d(a[0],c):2===e?d(a[0],a[1],c):3===e?d(a[0],a[1],a[2],c):h();break a}a=c}else a=9===b[0]?Db(b[1],b[2],a):b;a=zb(a);E(b,a);return a}
exports.force1=T;var Eb=[];exports.env_null_v=Eb;function Fb(a,b,c){for(var d=[],e=0;e<a.length;e+=2){if(V(a[e+0],b)){d[e+0]=b;d[e+1]=c;for(e+=2;e<a.length;e+=2)d[e+0]=a[e+0],d[e+1]=a[e+1];return d}d[e+0]=a[e+0];d[e+1]=a[e+1]}d[a.length+0]=b;d[a.length+1]=c;return d}exports.env_set=Fb;function Gb(a,b,c){for(var d=0;d<a.length;d+=2)if(V(a[d+0],b))return a[d+1];return c}exports.env_get=Gb;function Hb(a,b){for(var c=0;c<a.length;c+=2)if(V(a[c+0],b))return a[c+1];return h()}
function W(a){for(var b=w,c=0;c<a.length;c+=2)b=[1,N(a[c+0],a[c+1]),b];return[3,ta,N(b)]}exports.env2val=W;function Ib(a,b){for(var c=0;c<a.length;c+=2)b(a[c+0],a[c+1])}exports.env_foreach=Ib;
function Jb(a){a=D(a);if(!z(a))return!1;var b=D(a[1]);if(!u(b)||!xb(b,ta))return!1;b=D(a[2]);if(!v(b)||!x(D(b[2])))return!1;a=[];for(b=D(b[1]);!x(b);){if(!v(b))return!1;var c=D(b[1]);b=D(b[2]);if(!v(c))return!1;var d=c[1];c=D(c[2]);if(!v(c))return!1;var e=c[1];if(!x(D(c[2])))return!1;c=!0;for(var l=0;l<a.length;l+=2)if(V(a[l+0],d)){a[l+1]=e;c=!1;break}c&&(a.push(d),a.push(e))}return a}exports.val2env=Jb;
function Ab(a,b,c){var d=T(b);if(S(d))return c;var e=[4,F,N(sb,N(mb,N(W(a),d)))];if(v(d)){for(b=[];!x(d);){if(S(d))return c;if(v(d))b.push(d[1]),d=T(d[2]);else return e}if(V(b[0],tb)){if(1===b.length)return e;d=b[1];c=[];for(e=2;e<b.length;e++)c.push(b[e]);return[8,a,d,c]}if(V(b[0],ub)){if(1===b.length)return e;d=D([6,a,b[1]]);if(!z(d))return e;var l=T(d[1]);if(S(l))return c;if(!u(l)||!xb(l,I))return e;l=T(d[2]);if(S(l))return c;if(!v(l))return e;d=l[1];l=T(l[2]);if(S(l))return c;if(!x(l))return e;
c=[W(a)];for(e=2;e<b.length;e++)c.push(b[e]);return[9,d,c]}if(V(b[0],sb)){if(1===b.length)return e;d=b[1];c=[];for(e=2;e<b.length;e++)c.push([6,a,b[e]]);return[7,d,c]}d=[6,a,b[0]];c=[];for(e=1;e<b.length;e++)c.push([6,a,b[e]]);return[9,d,c]}return x(d)?d:u(d)||z(d)?Gb(a,d,e):A(d)?e:h()}function Kb(a,b){return[a,1,function(c){c=T(c);return S(c)?C(a,[c]):b(c)?wb:vb}]}function Lb(a,b,c){return[a,1,function(d,e){d=T(d);return S(d)?C(a,[d]):b(d)?c(d):e}]}
var Cb=[Kb($a,z),[Xa,2,ha],Lb(Ya,z,ia),Lb(Za,z,ja),Kb(db,A),[ab,2,ka],Lb(bb,A,la),Lb(cb,A,ma),Kb(jb,x),[eb,2,da],Kb(fb,v),Lb(gb,v,ea),Lb(hb,v,fa),[kb,2,function(a,b){function c(d,e,l,m){l=C(kb,[l(d),l(e)]);d=C(kb,[m(d),m(e)]);return C(ob,[l,d,vb])}if(a===b)return wb;a=T(a);b=T(b);if(S(a)||S(b))return C(kb,[a,b]);if(a===b)return wb;!S(a)||h();return x(a)?x(a)?wb:vb:u(a)?u(b)?xb(a,b)?wb:vb:vb:z(a)?z(b)?c(a,b,ia,ja):vb:v(a)?v(b)?c(a,b,ea,fa):vb:A(a)?A(b)?c(a,b,la,ma):vb:h()}],[lb,2,function(a,b,c){var d=
[];for(b=D(b);v(b);)d.push(b[1]),b=D(b[2]);return x(b)?[9,a,d]:c}],[mb,2,function(a,b,c){a=Jb(a);return!1===a?c:[6,a,b]}],Kb(ib,u),[nb,1,function(a,b){a=T(a);return S(a)?C(nb,[a]):v(a)?a[1]:b}],[ob,3,function(a,b,c,d){a=T(a);if(S(a))return C(ob,[a,b,c]);if(!z(a))return d;a=D(a[1]);return u(a)?xb(a,za)?b:xb(a,Aa)?c:d:d}]];
function Db(a,b,c){function d(){return[4,F,N(sb,N(lb,N(a,Q(b))))]}a=T(a);if(S(a))return c;if(!z(a))return d();c=D(a[1]);if(!u(c)||!xb(c,H))return d();var e=D(a[2]);if(!v(e))return d();c=na(e[1]);e=D(e[2]);if(!v(e)||!x(D(e[2])))return d();e=e[1];for(var l=Eb,m=0;!x(c);)if(u(c)||z(c)){for(var k=w,n=b.length-1;n>=m;n--)k=[1,b[n],k];l=Fb(l,c,k);m=b.length;c=w}else if(v(c))if(m<b.length)k=b[m],m++,l=Fb(l,c[1],k),c=c[2];else return d();else return d();return b.length!==m?d():[6,l,e]}
function Bb(a,b,c,d){void 0===d&&(d=!1);b=na(b);for(var e=[],l=!1,m=b;!x(m);)if(u(m)||z(m))e.push(m),l=!0,m=w;else if(v(m))e.push(m[1]),m=m[2];else return!1===d?ka(F,N(tb,N(W(a),qb,Q([b,c])))):d;d=b;l&&(d=Q(e));var k=[];Ib(a,function(n){for(var p=0;p<e.length;p++)if(V(e[p],n))return;k.push(n)});l=d;for(m=k.length-1;0<=m;m--)l=[1,k[m],l];for(m=k.length-1;0<=m;m--)d=da(N(tb,pb,Hb(a,k[m])),d);return ha(H,N(b,da(N(tb,pb,[3,H,N(l,c)]),d)))}
function V(a,b){function c(d,e,l,m){return V(l(d),l(e))&&V(m(d),m(e))?(E(d,e),!0):!1}if(a===b)return!0;a=D(a);b=D(b);if(a===b)return!0;if(x(a)){if(!x(b))return!1;E(a,w);E(b,w);return!0}return u(a)?u(b)?xb(a,b):!1:v(a)?v(b)?c(a,b,ea,fa):!1:A(a)?A(b)?c(a,b,la,ma):!1:z(a)?z(b)?c(a,b,ia,ja):!1:h()}exports.equal_p=V;
function X(a,b){function c(d,e,l,m){return X(l(d),l(e))&&X(m(d),m(e))?(E(d,e),!0):!1}if(a===b)return!0;a=zb(a);b=zb(b);if(a===b)return!0;if(x(a)){if(!x(b))return!1;E(a,w);E(b,w);return!0}if(u(a))return u(b)?xb(a,b):!1;if(v(a))return v(b)?c(a,b,ea,fa):!1;if(A(a))return A(b)?c(a,b,la,ma):!1;if(z(a))return z(b)?c(a,b,ia,ja):!1;if(6===a[0])throw"WIP";if(7===a[0])throw"WIP";if(8===a[0])throw"WIP";if(9===a[0])throw"WIP";return h()}
function U(a){a=zb(a);var b;if(x(a))return"()";if(v(a)){var c="(";for(b="";v(a);)c+=b+U(a[1]),b=" ",a=zb(a[2]);return c=x(a)?c+")":c+(" . "+U(a)+")")}return z(a)?"#"+U([1,a[1],a[2]]):A(a)?"!"+U([1,a[1],a[2]]):u(a)?ba(a):6===a[0]?"$("+U(W(a[1]))+" "+U(a[2])+")":7===a[0]?"%("+U(a[1])+" "+U(Q(a[2]))+")":8===a[0]?"@("+U(W(a[1]))+" "+U(a[2])+" "+U(Q(a[3]))+")":9===a[0]?"^("+U(a[1])+" "+U(Q(a[2]))+")":h()}exports.simple_print=U;exports.simple_print_force_all_rec=function(a){return U(na(a))};
function Mb(a){function b(){return Ra.length===xa}function c(){!b()||h();var f=Ra[xa];xa++;return f}function d(f){Ra[xa-1]===f||h();xa--}function e(f){void 0===f&&(f="");throw"TheLanguage parse ERROR!"+f;}function l(f){return" "===f||"\n"===f||"\t"===f||"\r"===f}function m(){if(b())return!1;var f=c();if(!l(f))return d(f),!1;for(;l(f)&&!b();)f=c();l(f)||d(f);return!0}function k(){if(b())return!1;var f=c(),t="";if(!J(f))return d(f),!1;for(;J(f)&&!b();)t+=f,f=c();J(f)?t+=f:d(f);t in aa||e("Not Symbol"+
t);return q(t)}function n(){if(b())return!1;var f=c();if("("!==f)return d(f),!1;for(var t=[10],g=t;;){m();if(b())return e();f=c();if(")"===f)return oa(t,w),g;if("."===f){m();f=Y();oa(t,f);m();if(b())return e();f=c();return")"!==f?e():g}d(f);f=Y();var r=[10];oa(t,[1,f,r]);t=r}}function p(){if(b())return!1;var f=c();if("#"!==f)return d(f),!1;f=n();return!1!==f&&v(f)?[3,f[1],f[2]]:e()}function B(){if(b())return!1;var f=c();if("!"!==f)return d(f),!1;f=n();return!1!==f&&v(f)?[4,f[1],f[2]]:e()}function O(f,
t){return function(){if(b())return!1;var g=c();if(g!==f)return d(g),!1;g=n();if(!1===g||!v(g))return e();var r=g[2];return v(r)&&x(r[2])?t(g[1],r[1]):e()}}function J(f){if(l(f))return!1;for(var t="()!#.$%^@~/->_:?[]&".split(""),g=0;g<t.length;g++)if(f===t[g])return!1;return!0}function Y(){m();for(var f=[n,Nb,p,B,Sa,Ta,Ua,Va],t=0;t<f.length;t++){var g=f[t]();if(!1!==g)return g}return e()}function G(f){return!1===f?e():f}function L(f){G(!b());G(c()===f)}function ya(){function f(r){function y(){L("[");
var Ob=f();L("]");return Ob}void 0===r&&(r=!1);r=r?[n,k,y,p,B,Sa,Ta,Ua,Va]:[n,ya,p,B,Sa,Ta,Ua,Va];for(var Wa=0;Wa<r.length;Wa++){var rb=r[Wa]();if(!1!==rb)return rb}return e()}function t(r){if(b())return r;var y=c();if("."===y)return y=f(),N(M,N(H,N(r),K),y);if(":"===y)return y=f(),N(M,y,r);if("~"===y)return N(va,r);if("@"===y)return y=f(),N(M,N(H,[1,r,K],K),y);if("?"===y)return N(M,H,N(va,r));if("/"===y){for(r=[r];;){y=f(!0);r.push(y);if(b())break;y=c();if("/"!==y){d(y);break}}return N(wa,Q(r))}d(y);
return r}if(b())return!1;var g=c();if("&"===g){G(!b());g=c();if("+"===g)return g=f(),N(I,N(F,g));d(g);g=f();return N(I,g)}if(":"===g){G(!b());g=c();if("&"===g)return L(">"),g=f(),N(M,N(I,N(H,K,g)),sa);if(">"===g)return g=f(),N(M,N(H,K,g),sa);d(g);g=f();return N(M,g,sa)}if("+"===g)return g=f(),N(F,g);if("["===g)return g=f(),L("]"),t(g);if("_"===g)return L(":"),g=f(),N(M,g,K);d(g);g=k();return!1===g?!1:t(g)}function Nb(){var f=ya();return!1===f?!1:u(f)?f:P(f)}var Ra=a,xa=0,Sa=O("$",function(f,t){var g=
Jb(f);return!1===g?e():[6,g,t]}),Ta=O("%",function(f,t){var g=yb(t,function(r){return r},function(){return e()});return[7,f,g]}),Ua=function(f,t){return function(){if(b())return!1;var g=c();if(g!==f)return d(g),!1;g=n();if(!1===g||!v(g))return e();var r=g[2];if(!v(r))return e();var y=r[2];return v(y)&&x(y[2])?t(g[1],r[1],y[1]):e()}}("@",function(f,t,g){g=yb(g,function(r){return r},function(){return e()});f=Jb(f);return!1===f?e():[8,f,t,g]}),Va=O("^",function(f,t){var g=yb(t,function(r){return r},
function(){return e()});return[9,f,g]});return Y()}exports.complex_parse=Mb;
function Z(a){function b(e,l){function m(O){return"inner"===l?"["+O+"]":"top"===l?O:h()}if(u(e))return ba(e);var k=R(e);if(!1!==k&&3===k.length&&X(k[0],M)){var n=R(k[1]);if(!1!==n&&3===n.length&&X(n[0],H)){var p=n[1],B=R(p);if(!1!==B&&1===B.length&&X(n[2],K))return m(b(B[0],"inner")+"."+b(k[2],"inner"));if(v(p)&&X(p[2],K)&&X(n[2],K))return m(b(p[1],"inner")+"@"+b(k[2],"inner"));if(X(p,K)&&X(k[2],sa))return m(":>"+b(n[2],"inner"))}p=R(k[2]);if(X(k[1],H)&&!1!==p&&2===p.length&&X(p[0],va))return m(b(p[1],
"inner")+"?");if(!1!==n&&2===n.length&&X(k[2],sa)&&X(n[0],I)&&(n=R(n[1]),!1!==n&&3===n.length&&X(n[0],H)&&X(n[1],K)))return m(":&>"+b(n[2],"inner"));n=X(k[2],K)?"_":X(k[2],sa)?"":b(k[2],"inner");return m(n+":"+b(k[1],"inner"))}if(!1!==k&&2===k.length){if(X(k[0],I))return n=R(k[1]),!1!==n&&2===n.length&&X(n[0],F)?m("&+"+b(n[1],"inner")):m("&"+b(k[1],"inner"));if(X(k[0],va))return m(b(k[1],"inner")+"~");if(X(k[0],F))return m("+"+b(k[1],"inner"));if(X(k[0],wa)&&(k=R(k[1]),!1!==k&&1<k.length)){n=b(k[0],
"inner");for(p=1;p<k.length;p++)n+="/"+b(k[p],"inner");return m(n)}}return"inner"===l?U(e):"top"===l?U(P(e)):h()}a=Mb(U(a));var c="",d="";if(x(a))return"()";if(v(a)){c="(";for(d="";v(a);)c+=d+Z(a[1]),d=" ",a=a[2];return c=x(a)?c+")":c+(" . "+Z(a)+")")}return z(a)?(c=a[1],a=a[2],d=R(a),!1!==d&&2===d.length&&X(c,pa)&&X(d[0],F)?b(d[1],"top"):"#"+Z([1,c,a])):A(a)?"!"+Z([1,a[1],a[2]]):u(a)?ba(a):6===a[0]?"$("+Z(W(a[1]))+" "+Z(a[2])+")":7===a[0]?"%("+Z(a[1])+" "+Z(Q(a[2]))+")":8===a[0]?"@("+Z(W(a[1]))+
" "+Z(a[2])+" "+Z(Q(a[3]))+")":9===a[0]?"^("+Z(a[1])+" "+Z(Q(a[2]))+")":h()}exports.complex_print=Z;
exports.machinetext_parse=function(a){function b(){function m(B){function O(G){var L=[10],ya=[10];k.push(L);k.push(ya);oa(B,G(L,ya))}var J=c();if("$"===J){for(J="";;){var Y=c();if("$"===Y)break;J+=Y}oa(B,[0,J])}else if("."===J)O(da);else if("#"===J)O(ha);else if("!"===J)O(ka);else if("_"===J)oa(B,w);else throw"WIP";}for(var k=[],n=0,p=e;n<p.length;n++)m(p[n]);e=k}function c(){if(!(a.length>l))throw"MT parse ERROR";var m=a[l];l++;return m}for(var d=[10],e=[d],l=0;0!==e.length;)b();if(l!=a.length)throw"MT parse ERROR";
return d};exports.machinetext_print=function(a){function b(){for(var e=[],l=0,m=c;l<m.length;l++){var k=m[l];k=zb(k);var n=function(p,B,O,J){d+=B;e.push(O(p));e.push(J(p))};if(u(k))d+="$",d+=k[1],d+="$";else if(v(k))n(k,".",ea,fa);else if(x(k))d+="_";else if(z(k))n(k,"#",ia,ja);else if(A(k))n(k,"!",la,ma);else throw"WIP";}c=e}for(var c=[a],d="";0!==c.length;)b();return d};
