package CSEN275.DPG.model;

import java.util.Map;

public record LoginInfo(String username, String password) {
    public LoginInfo(Map<String, String> map) {
        this(map.get("username"), map.get("password"));
    }
}
