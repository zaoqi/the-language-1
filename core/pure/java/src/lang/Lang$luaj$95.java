package lang;
public class Lang$luaj$95 extends org.luaj.vm2.lib.VarArgFunction {
    org.luaj.vm2.LuaValue u0;
    org.luaj.vm2.LuaValue u1;
    
    public Lang$luaj$95() {
    }
    
    final public org.luaj.vm2.Varargs onInvoke(org.luaj.vm2.Varargs a) {
        org.luaj.vm2.LuaValue a0 = a.arg(1);
        org.luaj.vm2.LuaValue a1 = a.arg(2);
        org.luaj.vm2.LuaValue a2 = a.arg(3);
        a.subargs(4);
        org.luaj.vm2.LuaValue a3 = this.u0.call(a0);
        if (a3.eq_b((org.luaj.vm2.LuaValue)org.luaj.vm2.LuaValue.FALSE)) {
            return org.luaj.vm2.LuaValue.tailcallOf(a2, (org.luaj.vm2.Varargs)org.luaj.vm2.LuaValue.NONE);
        }
        return org.luaj.vm2.LuaValue.tailcallOf(this.u1, org.luaj.vm2.LuaValue.varargsOf(a3, (org.luaj.vm2.Varargs)a1));
    }
}
