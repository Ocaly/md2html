#include <stdio.h>

int main(int argc, char **argv)
{
	(void)argc;
	printf("ARGV:          | *ARGV          | Value:\n");
	while (++argv && *argv)
		printf("%-#14zx | %-#14zx | '%s'\n",
				(size_t)argv,
				(size_t)*argv,
				*argv
		);
	return (0);
}
