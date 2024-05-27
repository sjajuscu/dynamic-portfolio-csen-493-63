package CSEN275.DPG.service;

import CSEN275.DPG.error.UserNotFoundException;
import CSEN275.DPG.model.User;
import CSEN275.DPG.repository.UserRepository;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.data.repository.query.Param;
import org.springframework.security.access.prepost.PreAuthorize;
import org.springframework.stereotype.Service;

import java.util.Collection;
import java.util.Optional;

@Service
public class UserServiceImpl implements UserService {

    private final UserRepository repository;

    @Autowired
    public UserServiceImpl(UserRepository repository) {
        this.repository = repository;
    }

    @Override
    public User createUser(User user) {
//        User existingUser = repository.findFirstByUsername(user.getUsername());
//        if (existingUser != null) {
//            throw new UsernameTakenException(user.getUsername());
//        }
        return repository.save(user);
    }

    @Override
    @PreAuthorize("hasRole('ROLE_ADMIN') or @authz.canEditUser(#id)")
    public User updateUser(User newUser, @Param("id") Long id) {
        Optional<User> optionalUser = repository.findById(id);
        if (optionalUser.isEmpty()) {
            throw new UserNotFoundException(id);
        }
        User existingUser = optionalUser.get();
        existingUser.update(newUser);
        return repository.save(existingUser);
    }

    @Override
    public Collection<User> getUsers() {
        return repository.findAll();
    }

    @Override
    public User getUser(Long id) {
        return repository.findById(id)
                .orElseThrow(() -> new UserNotFoundException(id));
    }

    @Override
    public void deleteUser(Long id) {
        repository.deleteById(id);
    }
}
