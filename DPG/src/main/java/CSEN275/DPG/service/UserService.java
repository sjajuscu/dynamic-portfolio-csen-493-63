package CSEN275.DPG.service;

import CSEN275.DPG.model.User;

import java.util.Collection;

public interface UserService {
    User createUser(User user);

    User updateUser(User newUser, Long id);

    User getUser(Long id);

    Collection<User> getUsers();

    void deleteUser(Long id);
}
