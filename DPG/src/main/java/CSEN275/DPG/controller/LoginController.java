package CSEN275.DPG.controller;

import CSEN275.DPG.error.UsernameTakenException;
import CSEN275.DPG.model.LoginInfo;
import CSEN275.DPG.model.UserInfo;
import CSEN275.DPG.repository.UserRepository;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.http.HttpStatus;
import org.springframework.http.ResponseEntity;
import org.springframework.security.core.userdetails.User;
import org.springframework.security.core.userdetails.UserDetails;
import org.springframework.security.provisioning.InMemoryUserDetailsManager;
import org.springframework.web.bind.annotation.PathVariable;
import org.springframework.web.bind.annotation.PostMapping;
import org.springframework.web.bind.annotation.RequestBody;
import org.springframework.web.bind.annotation.RequestMapping;

import java.util.Map;

//@RestController
public class LoginController {

    private final InMemoryUserDetailsManager inMemoryUserDetailsManager;
    private final UserRepository repository;

    @Autowired
    public LoginController(InMemoryUserDetailsManager inMemoryUserDetailsManager, UserRepository repository) {
        this.inMemoryUserDetailsManager = inMemoryUserDetailsManager;
        this.repository = repository;
    }

    @RequestMapping("/public/exists/{username}")
    public boolean userExists(@PathVariable("username") String username ) {
        return inMemoryUserDetailsManager.userExists(username);
    }

    @PostMapping("/public/register")
    public ResponseEntity<?> register(@RequestBody Map<String, Object> objectMap) {
        LoginInfo loginInfo = new LoginInfo((Map<String, String>) objectMap.get("loginInfo"));
        UserInfo userInfo = new UserInfo((Map<String, String>) objectMap.get("userInfo"));
        if (inMemoryUserDetailsManager.userExists(loginInfo.username())) {
            throw new UsernameTakenException(loginInfo.username());
        }
        UserDetails newUser = User.withDefaultPasswordEncoder()
                .username(loginInfo.username())
                .password(loginInfo.password())
                .roles("USER")
                .build();
        inMemoryUserDetailsManager.createUser(newUser);
//        repository.save(new CSEN275.DPG.model.User(loginInfo.username(), userInfo));
        return ResponseEntity.status(HttpStatus.CREATED).build();
    }
}
