public class lang$56$2 extends org.luaj.vm2.lib.TwoArgFunction {
    org.luaj.vm2.LuaValue u0;
    org.luaj.vm2.LuaValue[] u1;
    org.luaj.vm2.LuaValue u2;
    org.luaj.vm2.LuaValue u3;
    final static org.luaj.vm2.LuaValue k0;
    final static org.luaj.vm2.LuaValue k1;
    final static org.luaj.vm2.LuaValue k2;
    
    static {
        k0 = org.luaj.vm2.LuaValue.valueOf(0);
        k1 = org.luaj.vm2.LuaValue.valueOf(1);
        k2 = org.luaj.vm2.LuaString.valueOf("__TS__ArrayPush");
    }
    
    public lang$56$2() {
    }
    
    final public org.luaj.vm2.LuaValue call(org.luaj.vm2.LuaValue a, org.luaj.vm2.LuaValue a0) {
        org.luaj.vm2.LuaValue a1 = k0;
        while(a1.lt_b(this.u0.len())) {
            org.luaj.vm2.LuaValue a2 = this.u1[0];
            org.luaj.vm2.LuaValue a3 = a1.add(k1);
            if (a2.call(this.u0.get(a3), a).toboolean()) {
                return org.luaj.vm2.LuaValue.NONE;
            }
            a1 = a1.add(k1);
        }
        this.u2.get(k2).call(this.u3, a);
        return org.luaj.vm2.LuaValue.NONE;
    }
}
