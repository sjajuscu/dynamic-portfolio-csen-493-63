package CSEN275.DPG;

import org.junit.jupiter.api.Test;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.boot.test.autoconfigure.web.servlet.AutoConfigureMockMvc;
import org.springframework.boot.test.context.SpringBootTest;
import org.springframework.security.test.context.support.WithMockUser;
import org.springframework.test.web.servlet.MockMvc;

import static org.springframework.test.web.servlet.request.MockMvcRequestBuilders.get;
import static org.springframework.test.web.servlet.result.MockMvcResultMatchers.status;

@SpringBootTest
@AutoConfigureMockMvc
public class EndpointTest {
    @Autowired
    private MockMvc mvc;

    @WithMockUser(authorities="USER")
    @Test
    void endpointWhenUserAuthorityThenAuthorized() throws Exception {
        this.mvc.perform(get("/home"))
                .andExpect(status().isOk());
    }

    @WithMockUser
    @Test
    void endpointWhenNotUserAuthorityThenForbidden() throws Exception {
        this.mvc.perform(get("/"))
                .andExpect(status().isOk());
    }
}
