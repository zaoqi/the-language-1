package lang;
public class Lang$luaj$93$H_and extends org.luaj.vm2.lib.VarArgFunction {
    org.luaj.vm2.LuaValue u0;
    org.luaj.vm2.LuaValue u1;
    
    public Lang$luaj$93$H_and() {
    }
    
    final public org.luaj.vm2.Varargs onInvoke(org.luaj.vm2.Varargs a) {
        org.luaj.vm2.LuaValue a0 = a.arg(1);
        org.luaj.vm2.LuaValue a1 = a.arg(2);
        a.subargs(3);
        return org.luaj.vm2.LuaValue.tailcallOf(this.u0, org.luaj.vm2.LuaValue.varargsOf(a0, a1, (org.luaj.vm2.Varargs)this.u1));
    }
}
