package lang;
public class Lang$luaj$94 extends org.luaj.vm2.lib.VarArgFunction {
    org.luaj.vm2.LuaValue[] u0;
    org.luaj.vm2.LuaValue u1;
    org.luaj.vm2.LuaValue u2;
    org.luaj.vm2.LuaValue u3;
    org.luaj.vm2.LuaValue u4;
    org.luaj.vm2.LuaValue u5;
    org.luaj.vm2.LuaValue u6;
    
    public Lang$luaj$94() {
    }
    
    final public org.luaj.vm2.Varargs onInvoke(org.luaj.vm2.Varargs a) {
        org.luaj.vm2.LuaValue a0 = a.arg(1);
        org.luaj.vm2.LuaValue a1 = a.arg(2);
        org.luaj.vm2.LuaValue a2 = a.arg(3);
        a.subargs(4);
        org.luaj.vm2.LuaTable a3 = org.luaj.vm2.LuaValue.tableOf(0, 0);
        org.luaj.vm2.LuaValue a4 = this.u0[0].call(a1);
        while(this.u1.call(a4).toboolean()) {
            org.luaj.vm2.LuaValue a5 = this.u2;
            org.luaj.vm2.Varargs a6 = this.u3.invoke((org.luaj.vm2.Varargs)a4);
            org.luaj.vm2.LuaValue[] a7 = new org.luaj.vm2.LuaValue[1];
            a7[0] = a3;
            a5.invoke(org.luaj.vm2.LuaValue.varargsOf(a7, a6));
            a4 = this.u0[0].invoke(this.u4.invoke((org.luaj.vm2.Varargs)a4).subargs(1)).arg1();
        }
        if (!this.u5.call(a4).toboolean()) {
            return org.luaj.vm2.LuaValue.tailcallOf(a2, (org.luaj.vm2.Varargs)org.luaj.vm2.LuaValue.NONE);
        }
        return org.luaj.vm2.LuaValue.tailcallOf(this.u6, org.luaj.vm2.LuaValue.varargsOf(a0, (org.luaj.vm2.Varargs)a3));
    }
}
