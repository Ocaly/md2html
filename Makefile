SRC = $(shell find ./src/ -type f -regex '.*\.c')
CFLAGS=-g -Wall -Wextra

all:
	cc $(CFLAGS) -o wasmbuild $(SRC)
clean:
	rm -f wasmbuild

re: clean all

.PHONY: all clean re
