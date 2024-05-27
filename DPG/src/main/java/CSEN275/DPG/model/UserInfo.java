package CSEN275.DPG.model;

import java.util.Map;

public record UserInfo(String firstName, String lastName) {
    public UserInfo(Map<String, String> map) {
        this(map.get("firstName"), map.get("lastName"));
    }
}
